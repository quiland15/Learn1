import React, { useState, useMemo } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { MapPin, Calendar, Package, ChevronRight, ChevronLeft } from 'lucide-react';
import PickupStepWaste from './PickupStepWaste';
import PickupStepMap from './PickupStepMap';
import PickupStepSchedule from './PickupStepSchedule';

export default function PickupRequest({ prices, onCreated }) {
  const [step, setStep] = useState(1);
  const [form, setForm] = useState({
    category: 'plastic',
    category_label: 'Plastik',
    estimated_weight_kg: '',
    estimated_price: 0,
    lat: null,
    lng: null,
    address: '',
    scheduled_at: '',
  });

  const steps = [
    { id: 1, label: 'Input Sampah', icon: Package },
    { id: 2, label: 'Lokasi', icon: MapPin },
    { id: 3, label: 'Jadwal', icon: Calendar },
  ];

  const canProceed = useMemo(() => {
    if (step === 1)
      return form.category && form.estimated_weight_kg && Number(form.estimated_weight_kg) > 0;
    if (step === 2) return form.lat != null && form.lng != null;
    if (step === 3) return form.scheduled_at;
    return false;
  }, [step, form]);

  const handleSubmit = async () => {
    const res = await fetch('/api/pickup-requests', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
        Accept: 'application/json',
      },
      credentials: 'same-origin',
      body: JSON.stringify({
        category: form.category,
        category_label: form.category_label,
        estimated_weight_kg: Number(form.estimated_weight_kg),
        estimated_price: Number(form.estimated_price),
        lat: form.lat,
        lng: form.lng,
        address: form.address || null,
        scheduled_at: form.scheduled_at,
      }),
    });
    if (!res.ok) {
      const data = await res.json().catch(() => ({}));
      alert(data.message || 'Gagal mengirim permintaan.');
      return;
    }
    const data = await res.json();
    onCreated(data);
    setStep(1);
    setForm({
      category: 'plastic',
      category_label: 'Plastik',
      estimated_weight_kg: '',
      estimated_price: 0,
      lat: null,
      lng: null,
      address: '',
      scheduled_at: '',
    });
  };

  return (
    <div className="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
      <div className="flex items-center gap-2 mb-6">
        {steps.map((s, i) => (
          <React.Fragment key={s.id}>
            <button
              type="button"
              onClick={() => setStep(s.id)}
              className={`flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition ${
                step === s.id
                  ? 'bg-[#1E5631] text-white'
                  : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
              }`}
            >
              <s.icon className="w-4 h-4" />
              {s.label}
            </button>
            {i < steps.length - 1 && (
              <ChevronRight className="w-4 h-4 text-gray-400" />
            )}
          </React.Fragment>
        ))}
      </div>

      <AnimatePresence mode="wait">
        {step === 1 && (
          <motion.div
            key="step1"
            initial={{ opacity: 0, x: -10 }}
            animate={{ opacity: 1, x: 0 }}
            exit={{ opacity: 0, x: 10 }}
            transition={{ duration: 0.2 }}
          >
            <PickupStepWaste
              prices={prices}
              form={form}
              setForm={setForm}
            />
          </motion.div>
        )}
        {step === 2 && (
          <motion.div
            key="step2"
            initial={{ opacity: 0, x: -10 }}
            animate={{ opacity: 1, x: 0 }}
            exit={{ opacity: 0, x: 10 }}
            transition={{ duration: 0.2 }}
          >
            <PickupStepMap form={form} setForm={setForm} />
          </motion.div>
        )}
        {step === 3 && (
          <motion.div
            key="step3"
            initial={{ opacity: 0, x: -10 }}
            animate={{ opacity: 1, x: 0 }}
            exit={{ opacity: 0, x: 10 }}
            transition={{ duration: 0.2 }}
          >
            <PickupStepSchedule form={form} setForm={setForm} />
          </motion.div>
        )}
      </AnimatePresence>

      <div className="mt-6 flex justify-between">
        <button
          type="button"
          onClick={() => setStep((s) => Math.max(1, s - 1))}
          disabled={step === 1}
          className="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 disabled:opacity-50 flex items-center gap-2"
        >
          <ChevronLeft className="w-4 h-4" /> Sebelumnya
        </button>
        {step < 3 ? (
          <button
            type="button"
            onClick={() => setStep((s) => s + 1)}
            disabled={!canProceed}
            className="px-4 py-2 rounded-lg bg-[#8E24AA] text-white disabled:opacity-50 flex items-center gap-2"
          >
            Lanjut <ChevronRight className="w-4 h-4" />
          </button>
        ) : (
          <button
            type="button"
            onClick={handleSubmit}
            disabled={!canProceed}
            className="px-4 py-2 rounded-lg bg-[#1E5631] text-white disabled:opacity-50"
          >
            Kirim Request Jemput Sampah
          </button>
        )}
      </div>
    </div>
  );
}
