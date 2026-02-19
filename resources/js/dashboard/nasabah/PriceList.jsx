import React from 'react';

const LABELS = { plastic: 'Plastik', glass: 'Kaca', cans: 'Kaleng' };

export default function PriceList({ prices }) {
  if (!prices || typeof prices !== 'object') {
    return (
      <div className="rounded-xl border border-gray-200 bg-white p-6 text-gray-500 text-sm">
        Data harga belum tersedia.
      </div>
    );
  }

  const entries = Object.entries(prices);

  return (
    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      {entries.map(([cat, items]) => (
        <div
          key={cat}
          className="rounded-xl border border-gray-200 bg-white p-4 shadow-sm"
        >
          <h3 className="font-semibold text-[#1E5631] mb-3">
            {LABELS[cat] || cat}
          </h3>
          <ul className="space-y-2">
            {items.map((p) => (
              <li key={p.id} className="flex justify-between text-sm">
                <span className="text-gray-700">{p.name}</span>
                <span className="font-semibold text-[#8E24AA]">
                  Rp {Number(p.price_per_kg).toLocaleString('id-ID')}/kg
                </span>
              </li>
            ))}
          </ul>
        </div>
      ))}
    </div>
  );
}
