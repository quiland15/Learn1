import React, { useState } from 'react';
import { motion } from 'framer-motion';
import { Users, Truck, DollarSign, List, UserCheck } from 'lucide-react';
import PickupManagement from './admin/PickupManagement';
import UserManagement from './admin/UserManagement';

export default function AdminDashboard({ initial }) {
  const { user, stats = {}, pickups = [], users = [] } = initial;
  const [pickupsState, setPickupsState] = useState(pickups);

  const onVerified = (updated) => {
    setPickupsState((prev) =>
      prev.map((p) => (p.id === updated.id ? updated : p))
    );
  };

  return (
    <motion.div
      initial={{ opacity: 0, y: 8 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.3 }}
      className="space-y-8"
    >
      <h1 className="text-2xl font-bold text-[#1E5631]">Dashboard Admin</h1>

      {/* Stat Cards */}
      <section className="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div className="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <div className="flex items-center gap-3">
            <div className="rounded-lg bg-[#1E5631]/10 p-3">
              <Users className="w-6 h-6 text-[#1E5631]" />
            </div>
            <div>
              <p className="text-sm text-gray-600">Total Nasabah</p>
              <p className="text-2xl font-bold text-[#1E5631]">
                {stats.total_users ?? 0}
              </p>
            </div>
          </div>
        </div>
        <div className="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <div className="flex items-center gap-3">
            <div className="rounded-lg bg-[#8E24AA]/10 p-3">
              <Truck className="w-6 h-6 text-[#8E24AA]" />
            </div>
            <div>
              <p className="text-sm text-gray-600">Request Jemput Aktif</p>
              <p className="text-2xl font-bold text-[#8E24AA]">
                {stats.pending_pickups ?? 0}
              </p>
            </div>
          </div>
        </div>
        <div className="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <div className="flex items-center gap-3">
            <div className="rounded-lg bg-[#1E5631]/10 p-3">
              <DollarSign className="w-6 h-6 text-[#1E5631]" />
            </div>
            <div>
              <p className="text-sm text-gray-600">Total Revenue (Rp)</p>
              <p className="text-2xl font-bold text-[#1E5631]">
                {Number(stats.total_revenue ?? 0).toLocaleString('id-ID')}
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Pickup Management */}
      <section>
        <h2 className="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
          <List className="w-5 h-5 text-[#1E5631]" />
          Kelola Request Jemput Sampah
        </h2>
        <PickupManagement pickups={pickupsState} onVerified={onVerified} />
      </section>

      {/* User Management */}
      <section>
        <h2 className="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
          <UserCheck className="w-5 h-5 text-[#1E5631]" />
          Daftar Nasabah
        </h2>
        <UserManagement users={users} />
      </section>
    </motion.div>
  );
}
