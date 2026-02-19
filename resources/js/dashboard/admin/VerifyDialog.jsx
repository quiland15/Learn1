import React, { useState } from 'react';
import { motion } from 'framer-motion';
import { CheckCircle } from 'lucide-react';

export default function VerifyDialog({ pickup, onClose, onVerified }) {
  const [actualWeight, setActualWeight] = useState(
    String(pickup.estimated_weight_kg ?? '')
  );
  const [finalPrice, setFinalPrice] = useState(
    String(pickup.estimated_price ?? '')
  );
  const [loading, setLoading] = useState(false);

  const handleVerify = async () => {
    const weight = parseFloat(actualWeight);
    const price = parseFloat(finalPrice);
    if (isNaN(weight) || weight < 0 || isNaN(price) || price < 0) {
      alert('Isi berat aktual dan harga akhir dengan benar.');
      return;
    }
    setLoading(true);
    try {
      const res = await fetch(`/api/pickup-requests/${pickup.id}/verify`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
            ?.content || '',
          Accept: 'application/json',
        },
        credentials: 'same-origin',
        body: JSON.stringify({
          actual_weight_kg: weight,
          final_price: price,
        }),
      });
      if (!res.ok) {
        const data = await res.json().catch(() => ({}));
        alert(data.message || 'Gagal memverifikasi.');
        setLoading(false);
        return;
      }
      const data = await res.json();
      onVerified(data);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
      <motion.div
        initial={{ opacity: 0, scale: 0.95 }}
        animate={{ opacity: 1, scale: 1 }}
        className="bg-white rounded-2xl shadow-xl max-w-md w-full p-6"
      >
        <h3 className="text-lg font-semibold text-[#1E5631] mb-4">
          Konfirmasi Admin – Verify & Bayar
        </h3>
        <p className="text-sm text-gray-600 mb-4">
          Nasabah: <strong>{pickup.user?.name}</strong>
          <br />
          Kategori: {pickup.category_label} · Perkiraan: {pickup.estimated_weight_kg} kg
          (Rp {Number(pickup.estimated_price).toLocaleString('id-ID')})
        </p>
        <div className="space-y-4">
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">
              Berat Aktual (kg)
            </label>
            <input
              type="number"
              min="0"
              step="0.1"
              value={actualWeight}
              onChange={(e) => setActualWeight(e.target.value)}
              className="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
            />
          </div>
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-1">
              Harga Akhir (Rp)
            </label>
            <input
              type="number"
              min="0"
              value={finalPrice}
              onChange={(e) => setFinalPrice(e.target.value)}
              className="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
            />
          </div>
        </div>
        <div className="mt-6 flex gap-3 justify-end">
          <button
            type="button"
            onClick={onClose}
            className="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50"
          >
            Batal
          </button>
          <button
            type="button"
            onClick={handleVerify}
            disabled={loading}
            className="px-4 py-2 rounded-lg bg-[#1E5631] text-white hover:bg-[#164a28] disabled:opacity-50 flex items-center gap-2"
          >
            <CheckCircle className="w-4 h-4" />
            {loading ? 'Memproses...' : 'Verifikasi & Bayar'}
          </button>
        </div>
      </motion.div>
    </div>
  );
}
