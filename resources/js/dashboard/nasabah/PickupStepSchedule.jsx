import React from 'react';
import { format, addDays } from 'date-fns';

export default function PickupStepSchedule({ form, setForm }) {
  const minDate = format(addDays(new Date(), 1), 'yyyy-MM-dd');
  const [date, time] = (form.scheduled_at || '').split('T');

  const handleDate = (e) => {
    const d = e.target.value;
    const t = time || '09:00';
    setForm((f) => ({ ...f, scheduled_at: d ? `${d}T${t}` : '' }));
  };

  const handleTime = (e) => {
    const t = e.target.value;
    const d = date || minDate;
    setForm((f) => ({ ...f, scheduled_at: d ? `${d}T${t}` : '' }));
  };

  return (
    <div className="space-y-4">
      <div>
        <label className="block text-sm font-medium text-gray-700 mb-1">
          Tanggal Penjemputan
        </label>
        <input
          type="date"
          min={minDate}
          value={date || ''}
          onChange={handleDate}
          className="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
        />
      </div>
      <div>
        <label className="block text-sm font-medium text-gray-700 mb-1">
          Waktu (perkiraan)
        </label>
        <input
          type="time"
          value={time || '09:00'}
          onChange={handleTime}
          className="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
        />
      </div>
    </div>
  );
}
