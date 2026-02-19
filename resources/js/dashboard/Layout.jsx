import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { Menu, X, LogOut, LayoutDashboard } from 'lucide-react';

export default function Layout({ user, role, children }) {
  const [open, setOpen] = useState(false);

  return (
    <div className="min-h-screen bg-gray-50">
      <header className="sticky top-0 z-40 border-b border-gray-200 bg-white">
        <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-14">
          <Link to="/" className="font-semibold text-[#1E5631] flex items-center gap-2">
            <LayoutDashboard className="w-5 h-5" />
            Start Green
          </Link>
          <div className="flex items-center gap-3">
            <span className="text-sm text-gray-600 hidden sm:inline">
              {user.name} {role === 'admin' && '(Admin)'}
            </span>
            <form method="POST" action="/logout" className="inline">
              <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]')?.content} />
              <button type="submit" className="flex items-center gap-1 text-sm text-gray-600 hover:text-[#8E24AA]">
                <LogOut className="w-4 h-4" /> Keluar
              </button>
            </form>
          </div>
        </div>
      </header>
      <main className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {children}
      </main>
    </div>
  );
}
