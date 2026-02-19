import React, { useMemo } from 'react';

const LABELS = { plastic: 'Plastik', glass: 'Kaca', cans: 'Kaleng' };

function getPriceForCategory(prices, category) {
  if (!prices || !prices[category] || !prices[category].length) return 0;
  return Number(prices[category][0].price_per_kg) || 0;
}

export default function PickupStepWaste({ prices, form, setForm }) {
  const pricePerKg = useMemo(
    () => getPriceForCategory(prices, form.category),
    [prices, form.category]
  );

  const estimatedPrice = useMemo(() => {
    const kg = Number(form.estimated_weight_kg) || 0;
    return Math.round(kg * pricePerKg);
  }, [form.estimated_weight_kg, pricePerKg]);

  React.useEffect(() => {
    setForm((f) => ({
      ...f,
      category_label: LABELS[f.category] || f.category,
      estimated_price: estimatedPrice,
    }));
  }, [estimatedPrice, form.category]);

  return (
    <div className="space-y-4">
      <div>
        <label className="block text-sm font-medium text-gray-700 mb-1">
          Kategori Sampah
        </label>
        <select
          value={form.category}
          onChange={(e) =>
            setForm((f) => ({
              ...f,
              category: e.target.value,
              category_label: LABELS[e.target.value] || e.target.value,
            }))
          }
          className="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
        >
          <option value="plastic">Plastik</option>
          <option value="glass">Kaca</option>
          <option value="cans">Kaleng</option>
        </select>
      </div>
      <div>
        <label className="block text-sm font-medium text-gray-700 mb-1">
          Perkiraan Berat (kg)
        </label>
        <input
          type="number"
          min="0.1"
          step="0.1"
          value={form.estimated_weight_kg}
          onChange={(e) =>
            setForm((f) => ({ ...f, estimated_weight_kg: e.target.value }))
          }
          className="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
          placeholder="Contoh: 5"
        />
      </div>
      <div className="rounded-lg bg-[#1E5631]/5 border border-[#1E5631]/20 p-4">
        <p className="text-sm text-gray-600">Perkiraan Harga (berdasarkan harga terkini)</p>
        <p className="text-xl font-bold text-[#1E5631]">
          Rp {estimatedPrice.toLocaleString('id-ID')}
        </p>
        <p className="text-xs text-gray-500 mt-1">
          Rp {pricePerKg.toLocaleString('id-ID')}/kg × {form.estimated_weight_kg || '0'} kg
        </p>
      </div>
    </div>
  );
}
