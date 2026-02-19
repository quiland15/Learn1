import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import { motion, AnimatePresence } from 'framer-motion';
import NasabahDashboard from './NasabahDashboard';
import AdminDashboard from './AdminDashboard';
import Layout from './Layout';

export default function App({ initial }) {
  const { user, role } = initial;

  if (!user || !role) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-gray-50">
        <p className="text-gray-500">Memuat...</p>
      </div>
    );
  }

  return (
    <Layout user={user} role={role}>
      <AnimatePresence mode="wait">
        <Routes>
          <Route path="/" element={role === 'nasabah' ? <NasabahDashboard initial={initial} /> : <AdminDashboard initial={initial} />} />
          <Route path="*" element={<Navigate to="/" replace />} />
        </Routes>
      </AnimatePresence>
    </Layout>
  );
}
