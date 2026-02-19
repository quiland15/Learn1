import React from 'react';
import { format } from 'date-fns';
import { id } from 'date-fns/locale';
import { Clock, CheckCircle, Loader2 } from 'lucide-react';

const statusConfig = {
  pending: { label: 'Menunggu', color: 'bg-amber-100 text-amber-800', icon: Clock },
  on_progress: { label: 'Diproses', color: 'bg-blue-100 text-blue-800', icon: Loader2 },
  completed: { label: 'Selesai', color: 'bg-green-100 text-green-800', icon: CheckCircle },
};

export default function ActivityHistory({ pickups }) {
  if (!pickups || pickups.length === 0) {
    return (
      <div className="rounded-xl border border-gray-200 bg-white p-6 text-gray-500 text-sm">
        Belum ada riwayat permintaan jemput sampah.
      </div>
    );
  }

  return (
    <div className="rounded-xl border border-gray-200 bg-white overflow-hidden shadow-sm">
      <ul className="divide-y divide-gray-200">
        {pickups.map((p) => {
          const config = statusConfig[p.status] || statusConfig.pending;
          const Icon = config.icon;
          return (
            <li key={p.id} className="p-4 flex flex-wrap items-center justify-between gap-2">
              <div>
                <p className="font-medium text-gray-900">
                  {p.category_label} · {Number(p.estimated_weight_kg)} kg
                </p>
                <p className="text-sm text-gray-500">
                  {p.scheduled_at
                    ? format(new Date(p.scheduled_at), 'd MMM yyyy, HH:mm', {
                        locale: id,
                      })
                    : '-'}
                </p>
              </div>
              <div className="flex items-center gap-3">
                {p.status === 'completed' && p.final_price != null && (
                  <span className="font-semibold text-[#1E5631]">
                    Rp {Number(p.final_price).toLocaleString('id-ID')}
                  </span>
                )}
                <span
                  className={`inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium ${config.color}`}
                >
                  <Icon className="w-3 h-3" />
                  {config.label}
                </span>
              </div>
            </li>
          );
        })}
      </ul>
    </div>
  );
}
