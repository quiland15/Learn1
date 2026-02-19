import React, { useState, useMemo } from 'react';
import { motion } from 'framer-motion';
import { Wallet, Scale, List, MapPin, Calendar, History } from 'lucide-react';
import PriceList from './nasabah/PriceList';
import PickupRequest from './nasabah/PickupRequest';
import ActivityHistory from './nasabah/ActivityHistory';

export default function NasabahDashboard({ initial }) {
  const { user, prices = {}, pickups = [] } = initial;
  const [pickupsState, setPickupsState] = useState(pickups);

  const totalEarnings = useMemo(() => {
    return pickupsState
      .filter((p) => p.status === 'completed' && p.final_price)
      .reduce((s, p) => s + Number(p.final_price), 0);
  }, [pickupsState]);

  const totalWeight = useMemo(() => {
    return pickupsState
      .filter((p) => p.status === 'completed' && p.actual_weight_kg)
      .reduce((s, p) => s + Number(p.actual_weight_kg), 0);
  }, [pickupsState]);

  const onPickupCreated = (newPickup) => {
    setPickupsState((prev) => [newPickup, ...prev]);
  };

  return (
    <motion.div
      initial={{ opacity: 0, y: 8 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.3 }}
      className="space-y-8"
    >
      <h1 className="text-2xl font-bold text-[#1E5631]">Dashboard Nasabah</h1>

      {/* Balance Overview */}
      <section className="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div className="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <div className="flex items-center gap-3">
            <div className="rounded-lg bg-[#1E5631]/10 p-3">
              <Wallet className="w-6 h-6 text-[#1E5631]" />
            </div>
            <div>
              <p className="text-sm text-gray-600">Saldo Tabungan</p>
              <p className="text-2xl font-bold text-[#1E5631]">
                Rp {Number(user?.balance ?? 0).toLocaleString('id-ID')}
              </p>
            </div>
          </div>
        </div>
        <div className="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <div className="flex items-center gap-3">
            <div className="rounded-lg bg-[#8E24AA]/10 p-3">
              <Scale className="w-6 h-6 text-[#8E24AA]" />
            </div>
            <div>
              <p className="text-sm text-gray-600">Total Berat Terkelola</p>
              <p className="text-2xl font-bold text-[#8E24AA]">
                {totalWeight.toFixed(1)} kg
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Dynamic Price List */}
      <section>
        <h2 className="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
          <List className="w-5 h-5 text-[#1E5631]" />
          Harga Sampah Terkini
        </h2>
        <PriceList prices={prices} />
      </section>

      {/* Pickup Request */}
      <section>
        <h2 className="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
          <MapPin className="w-5 h-5 text-[#1E5631]" />
          Request Jemput Sampah
        </h2>
        <PickupRequest prices={prices} onCreated={onPickupCreated} />
      </section>

      {/* Activity History */}
      <section>
        <h2 className="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
          <History className="w-5 h-5 text-[#1E5631]" />
          Riwayat Permintaan
        </h2>
        <ActivityHistory pickups={pickupsState} />
      </section>
    </motion.div>
  );
}
