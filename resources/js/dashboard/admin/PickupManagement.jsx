import React, { useState } from 'react';
import { motion } from 'framer-motion';
import { format } from 'date-fns';
import { id } from 'date-fns/locale';
import { MapPin, CheckCircle } from 'lucide-react';
import { MapContainer, TileLayer, Marker, useMap } from 'react-leaflet';
import L from 'leaflet';
import VerifyDialog from './VerifyDialog';

export default function PickupManagement({ pickups, onVerified }) {
  const [selected, setSelected] = useState(null);
  const [showMap, setShowMap] = useState(false);

  const pending = pickups.filter((p) => p.status === 'pending');
  const all = pickups;

  return (
    <div className="rounded-xl border border-gray-200 bg-white overflow-hidden shadow-sm">
      <div className="overflow-x-auto">
        <table className="min-w-full divide-y divide-gray-200">
          <thead className="bg-gray-50">
            <tr>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Nasabah / Tanggal
              </th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Kategori / Berat
              </th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Status
              </th>
              <th className="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody className="divide-y divide-gray-200">
            {all.map((p) => (
              <tr key={p.id} className="bg-white hover:bg-gray-50">
                <td className="px-4 py-3">
                  <p className="font-medium text-gray-900">
                    {p.user?.name ?? '–'}
                  </p>
                  <p className="text-sm text-gray-500">
                    {p.scheduled_at
                      ? format(new Date(p.scheduled_at), 'd MMM yyyy, HH:mm', {
                          locale: id,
                        })
                      : '–'}
                  </p>
                </td>
                <td className="px-4 py-3">
                  <p className="text-gray-900">
                    {p.category_label} · {Number(p.estimated_weight_kg)} kg
                  </p>
                  <p className="text-sm text-[#8E24AA]">
                    Perkiraan: Rp{' '}
                    {Number(p.estimated_price).toLocaleString('id-ID')}
                  </p>
                </td>
                <td className="px-4 py-3">
                  <span
                    className={`inline-flex px-2 py-1 rounded-full text-xs font-medium ${
                      p.status === 'pending'
                        ? 'bg-amber-100 text-amber-800'
                        : p.status === 'on_progress'
                        ? 'bg-blue-100 text-blue-800'
                        : 'bg-green-100 text-green-800'
                    }`}
                  >
                    {p.status === 'pending'
                      ? 'Menunggu'
                      : p.status === 'on_progress'
                      ? 'Diproses'
                      : 'Selesai'}
                  </span>
                </td>
                <td className="px-4 py-3 text-right">
                  {p.lat != null && p.lng != null && (
                    <button
                      type="button"
                      onClick={() => {
                        setSelected(p);
                        setShowMap(true);
                      }}
                      className="inline-flex items-center gap-1 text-sm text-[#1E5631] hover:underline mr-2"
                    >
                      <MapPin className="w-4 h-4" /> Peta
                    </button>
                  )}
                  {p.status === 'pending' && (
                    <button
                      type="button"
                      onClick={() => {
                        setSelected(p);
                        setShowMap(false);
                      }}
                      className="inline-flex items-center gap-1 text-sm px-3 py-1.5 rounded-lg bg-[#8E24AA] text-white hover:bg-[#7b1fa2]"
                    >
                      <CheckCircle className="w-4 h-4" /> Konfirmasi Admin
                    </button>
                  )}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
      {all.length === 0 && (
        <div className="p-8 text-center text-gray-500 text-sm">
          Belum ada request jemput sampah.
        </div>
      )}

      {selected && showMap && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
          <motion.div
            initial={{ opacity: 0, scale: 0.95 }}
            animate={{ opacity: 1, scale: 1 }}
            className="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-hidden"
          >
            <div className="p-4 border-b flex justify-between items-center">
              <h3 className="font-semibold text-[#1E5631]">Lokasi Penjemputan</h3>
              <button
                type="button"
                onClick={() => setSelected(null)}
                className="text-gray-500 hover:text-gray-700"
              >
                ✕
              </button>
            </div>
            <div className="h-[400px] bg-gray-100">
              <MapView lat={selected.lat} lng={selected.lng} />
            </div>
          </motion.div>
        </div>
      )}

      {selected && !showMap && (
        <VerifyDialog
          pickup={selected}
          onClose={() => setSelected(null)}
          onVerified={(updated) => {
            onVerified(updated);
            setSelected(null);
          }}
        />
      )}
    </div>
  );
}

function MapView({ lat, lng }) {
  const icon = L.icon({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
  });
  return (
    <MapContainer
      center={[lat, lng]}
      zoom={15}
      style={{ height: '100%', width: '100%' }}
      scrollWheelZoom={false}
    >
      <TileLayer
        attribution='&copy; OpenStreetMap'
        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      />
      <Marker position={[lat, lng]} icon={icon} />
    </MapContainer>
  );
}
