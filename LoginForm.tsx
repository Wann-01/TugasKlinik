
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Label } from '@/components/ui/label';
import { toast } from '@/hooks/use-toast';
import { login } from '@/utils/auth';
import { User } from '@/types';
import { X, Stethoscope, Users } from 'lucide-react';

interface LoginFormProps {
  onLogin: (user: User) => void;
  onClose: () => void;
}

const LoginForm = ({ onLogin, onClose }: LoginFormProps) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [isLoading, setIsLoading] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      const user = login(email, password);
      if (user) {
        onLogin(user);
        toast({
          title: "Login berhasil",
          description: `Selamat datang, ${user.name}!`,
        });
      } else {
        toast({
          title: "Login gagal",
          description: "Email atau password salah",
          variant: "destructive",
        });
      }
    } catch (error) {
      toast({
        title: "Error",
        description: "Terjadi kesalahan saat login",
        variant: "destructive",
      });
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
      <div className="w-full max-w-md relative">
        <Card className="shadow-2xl border-0 bg-white/95 backdrop-blur-md">
          <CardHeader className="text-center relative pb-6">
            <Button
              onClick={onClose}
              variant="ghost"
              size="sm"
              className="absolute right-2 top-2 h-8 w-8 p-0 hover:bg-gray-100 rounded-full"
            >
              <X className="h-4 w-4" />
            </Button>
            
            <div className="mx-auto bg-gradient-to-r from-blue-600 to-green-600 p-3 rounded-xl mb-4 w-fit">
              <Stethoscope className="h-8 w-8 text-white" />
            </div>
            
            <CardTitle className="text-2xl md:text-3xl font-bold bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
              Klinik Sehat
            </CardTitle>
            <CardDescription className="text-base text-gray-600 mt-2">
              Masuk ke sistem klinik
            </CardDescription>
          </CardHeader>
          
          <CardContent className="space-y-6">
            <form onSubmit={handleSubmit} className="space-y-5">
              <div className="space-y-2">
                <Label htmlFor="email" className="text-sm font-medium text-gray-700">
                  Email
                </Label>
                <Input
                  id="email"
                  type="email"
                  placeholder="admin@klinik.com"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  required
                  className="h-12 border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg"
                />
              </div>
              
              <div className="space-y-2">
                <Label htmlFor="password" className="text-sm font-medium text-gray-700">
                  Password
                </Label>
                <Input
                  id="password"
                  type="password"
                  placeholder="password123"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required
                  className="h-12 border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg"
                />
              </div>
              
              <Button
                type="submit"
                className="w-full h-12 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200"
                disabled={isLoading}
              >
                {isLoading ? (
                  <div className="flex items-center space-x-2">
                    <div className="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin" />
                    <span>Memproses...</span>
                  </div>
                ) : (
                  <div className="flex items-center space-x-2">
                    <Users className="h-4 w-4" />
                    <span>Masuk</span>
                  </div>
                )}
              </Button>
            </form>
            
            <div className="bg-gradient-to-r from-blue-50 to-green-50 p-4 rounded-lg border border-blue-100">
              <p className="font-semibold text-sm text-gray-800 mb-3">Demo Akun:</p>
              <div className="grid grid-cols-2 gap-2 text-xs text-gray-600">
                <div>
                  <p className="font-medium">Admin:</p>
                  <p>admin@klinik.com</p>
                </div>
                <div>
                  <p className="font-medium">Dokter:</p>
                  <p>dokter1@klinik.com</p>
                </div>
                <div>
                  <p className="font-medium">Perawat:</p>
                  <p>perawat@klinik.com</p>
                </div>
                <div>
                  <p className="font-medium">Pegawai:</p>
                  <p>pegawai@klinik.com</p>
                </div>
              </div>
              <p className="text-xs text-gray-500 mt-2 text-center">
                Password: <span className="font-mono bg-gray-100 px-1 rounded">password123</span>
              </p>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  );
};

export default LoginForm;
