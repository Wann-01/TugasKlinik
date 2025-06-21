
import { useState, useEffect } from 'react';
import { getCurrentUser, initializeUsers } from '@/utils/auth';
import { getTodaysDoctors } from '@/utils/doctors';
import { User, Doctor, Patient } from '@/types';
import LoginForm from '@/components/LoginForm';
import Header from '@/components/Header';
import DoctorCard from '@/components/DoctorCard';
import AppointmentModal from '@/components/AppointmentModal';
import Calendar from '@/components/Calendar';
import NewsSection from '@/components/NewsSection';
import AdminDashboard from '@/components/dashboards/AdminDashboard';
import DoctorDashboard from '@/components/dashboards/DoctorDashboard';
import NurseDashboard from '@/components/dashboards/NurseDashboard';
import StaffDashboard from '@/components/dashboards/StaffDashboard';
import { Button } from '@/components/ui/button';
import { Stethoscope, Calendar as CalendarIcon, Users, Heart } from 'lucide-react';

const Index = () => {
  const [user, setUser] = useState<User | null>(null);
  const [selectedDoctor, setSelectedDoctor] = useState<Doctor | null>(null);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [isLoginOpen, setIsLoginOpen] = useState(false);
  const [todaysDoctors, setTodaysDoctors] = useState<Doctor[]>([]);

  useEffect(() => {
    initializeUsers();
    const currentUser = getCurrentUser();
    setUser(currentUser);
    setTodaysDoctors(getTodaysDoctors());
  }, []);

  const handleLogin = (loggedInUser: User) => {
    setUser(loggedInUser);
    setIsLoginOpen(false);
  };

  const handleLogout = () => {
    setUser(null);
    setIsLoginOpen(false);
  };

  const handleBookAppointment = (doctor: Doctor) => {
    setSelectedDoctor(doctor);
    setIsModalOpen(true);
  };

  const handleAppointmentSubmit = (patientData: Omit<Patient, 'id'>) => {
    const newPatient: Patient = {
      ...patientData,
      id: Date.now().toString()
    };

    // Save to localStorage
    const existingPatients = JSON.parse(localStorage.getItem('clinic_patients') || '[]');
    existingPatients.push(newPatient);
    localStorage.setItem('clinic_patients', JSON.stringify(existingPatients));
  };

  // Show login form if login is requested
  if (isLoginOpen) {
    return <LoginForm onLogin={handleLogin} onClose={() => setIsLoginOpen(false)} />;
  }

  // Show role-specific dashboard if user is logged in as staff
  if (user && (user.role === 'admin' || user.role === 'doctor' || user.role === 'nurse' || user.role === 'staff')) {
    const renderDashboard = () => {
      switch (user.role) {
        case 'admin':
          return <AdminDashboard />;
        case 'doctor':
          return <DoctorDashboard />;
        case 'nurse':
          return <NurseDashboard />;
        case 'staff':
          return <StaffDashboard />;
        default:
          return <div>Invalid role</div>;
      }
    };

    return (
      <div className="min-h-screen bg-gray-50">
        <Header user={user} onLogout={handleLogout} />
        {renderDashboard()}
      </div>
    );
  }

  // Show modern public homepage
  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
      {/* Modern Header */}
      <header className="bg-white/80 backdrop-blur-md shadow-sm border-b sticky top-0 z-40">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-16 md:h-20">
            <div className="flex items-center space-x-3">
              <div className="bg-gradient-to-r from-blue-600 to-green-600 p-2 rounded-xl">
                <Stethoscope className="h-6 w-6 md:h-8 md:w-8 text-white" />
              </div>
              <h1 className="text-xl md:text-2xl lg:text-3xl font-bold bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
                Klinik Sehat
              </h1>
            </div>
            
            <Button
              onClick={() => setIsLoginOpen(true)}
              className="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 md:px-6 md:py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200"
            >
              <Users className="h-4 w-4 mr-2" />
              Login Staff
            </Button>
          </div>
        </div>
      </header>
      
      {/* Hero Section */}
      <section className="py-12 md:py-20 lg:py-24">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12 md:mb-16">
            <div className="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-100 to-green-100 px-4 py-2 rounded-full mb-6">
              <Heart className="h-5 w-5 text-blue-600" />
              <span className="text-sm font-medium text-blue-800">Pelayanan Kesehatan Terpercaya</span>
            </div>
            <h1 className="text-3xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
              Selamat Datang di
              <span className="block bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
                Klinik Sehat
              </span>
            </h1>
            <p className="text-lg md:text-xl lg:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
              Memberikan pelayanan kesehatan terbaik dengan dokter berpengalaman 
              dan fasilitas modern untuk keluarga Anda
            </p>
          </div>

          {/* Today's Doctors Section */}
          <div className="mb-16 md:mb-20">
            <div className="text-center mb-12">
              <div className="inline-flex items-center space-x-2 mb-4">
                <CalendarIcon className="h-6 w-6 text-blue-600" />
                <h2 className="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">
                  Dokter Bertugas Hari Ini
                </h2>
              </div>
              <p className="text-gray-600 text-base md:text-lg">
                Tim dokter profesional siap melayani Anda
              </p>
            </div>
            
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
              {todaysDoctors.map((doctor) => (
                <DoctorCard
                  key={doctor.id}
                  doctor={doctor}
                  onBookAppointment={handleBookAppointment}
                />
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Calendar and News Sections */}
      <div className="bg-white/50 backdrop-blur-sm">
        <Calendar />
        <NewsSection />
      </div>

      {/* Appointment Modal */}
      <AppointmentModal
        doctor={selectedDoctor}
        isOpen={isModalOpen}
        onClose={() => setIsModalOpen(false)}
        onSubmit={handleAppointmentSubmit}
      />
    </div>
  );
};

export default Index;
