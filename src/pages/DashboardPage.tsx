import React from 'react';
import { useAuth } from '../contexts/AuthContext';
import { Button } from '../components/ui/Button';

export const DashboardPage: React.FC = () => {
  const { user, logout, hasRole } = useAuth();

  const handleLogout = async () => {
    await logout();
  };

  return (
    <div className="min-h-screen bg-background">
      <header className="border-b bg-card">
        <div className="container mx-auto px-4 py-4 flex justify-between items-center">
          <h1 className="text-2xl font-bold">Training Management Platform</h1>
          <div className="flex items-center gap-4">
            <span className="text-sm text-muted-foreground">
              Welcome, {user?.name}
            </span>
            <Button onClick={handleLogout} variant="outline" size="sm">
              Sign Out
            </Button>
          </div>
        </div>
      </header>

      <main className="container mx-auto px-4 py-8">
        <div className="space-y-8">
          <div>
            <h2 className="text-3xl font-bold mb-2">Dashboard</h2>
            <p className="text-muted-foreground">
              Welcome to your training management dashboard
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div className="p-6 border rounded-lg bg-card">
              <h3 className="font-semibold text-lg mb-2">Your Profile</h3>
              <div className="space-y-2 text-sm">
                <p><span className="font-medium">Name:</span> {user?.name}</p>
                <p><span className="font-medium">Email:</span> {user?.email}</p>
                <p><span className="font-medium">Role:</span> {user?.role?.name || 'No role assigned'}</p>
                <p><span className="font-medium">Status:</span> 
                  <span className={user?.is_active ? 'text-green-600' : 'text-red-600'}>
                    {user?.is_active ? ' Active' : ' Inactive'}
                  </span>
                </p>
              </div>
            </div>

            <div className="p-6 border rounded-lg bg-card">
              <h3 className="font-semibold text-lg mb-2">Quick Actions</h3>
              <div className="space-y-2">
                <Button variant="outline" className="w-full justify-start">
                  View Courses
                </Button>
                <Button variant="outline" className="w-full justify-start">
                  Training Schedule
                </Button>
                <Button variant="outline" className="w-full justify-start">
                  Progress Reports
                </Button>
              </div>
            </div>

            <div className="p-6 border rounded-lg bg-card">
              <h3 className="font-semibold text-lg mb-2">Role-Based Access</h3>
              <div className="space-y-2">
                {hasRole('ADMIN') && (
                  <Button variant="outline" className="w-full justify-start">
                    Admin Panel
                  </Button>
                )}
                {hasRole('TRAINER') && (
                  <Button variant="outline" className="w-full justify-start">
                    Trainer Tools
                  </Button>
                )}
                <p className="text-xs text-muted-foreground mt-2">
                  Your role: {user?.role?.name || 'USER'}
                </p>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  );
};