
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Doctor } from '@/types';
import { Clock, User, Calendar } from 'lucide-react';

interface DoctorCardProps {
  doctor: Doctor;
  onBookAppointment: (doctor: Doctor) => void;
}

const DoctorCard = ({ doctor, onBookAppointment }: DoctorCardProps) => {
  return (
    <Card className="group hover:shadow-2xl transition-all duration-300 bg-white/70 backdrop-blur-sm border-0 shadow-lg hover:scale-[1.02] overflow-hidden">
      <CardHeader className="text-center pb-4 relative">
        <div className="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-green-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
        
        <div className="relative z-10">
          <div className="w-20 h-20 md:w-24 md:h-24 mx-auto mb-4 bg-gradient-to-br from-blue-100 to-green-100 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
            <User className="h-8 w-8 md:h-10 md:w-10 text-blue-600" />
          </div>
          
          <CardTitle className="text-lg md:text-xl font-bold text-gray-900 mb-2">
            {doctor.name}
          </CardTitle>
          
          <Badge 
            variant="secondary" 
            className="mx-auto bg-gradient-to-r from-blue-100 to-green-100 text-blue-800 border-0 px-3 py-1 text-sm font-medium"
          >
            {doctor.specialization}
          </Badge>
        </div>
      </CardHeader>
      
      <CardContent className="text-center space-y-4 relative z-10">
        <div className="flex items-center justify-center space-x-2 text-gray-600 bg-gray-50/80 rounded-lg p-3">
          <Clock className="h-4 w-4 text-blue-600" />
          <span className="text-sm font-medium">08:00 - 16:00</span>
        </div>
        
        <div className="flex items-center justify-center space-x-2 text-gray-600">
          <Calendar className="h-4 w-4 text-green-600" />
          <span className="text-sm">Tersedia hari ini</span>
        </div>
        
        <Button
          onClick={() => onBookAppointment(doctor)}
          className="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200"
        >
          <User className="h-4 w-4 mr-2" />
          Daftar Konsultasi
        </Button>
      </CardContent>
    </Card>
  );
};

export default DoctorCard;
