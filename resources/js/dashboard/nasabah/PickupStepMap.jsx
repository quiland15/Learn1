import React, { useState, useEffect, useRef } from 'react';
import { MapContainer, TileLayer, Marker, useMapEvents } from 'react-leaflet';
import L from 'leaflet';

function LocationPicker({ form, setForm }) {
  const map = useMapEvents({
    click(e) {
      setForm((f) => ({
        ...f,
        lat: e.latlng.lat,
        lng: e.latlng.lng,
      }));
    },
  });

  useEffect(() => {
    if (form.lat != null && form.lng != null) {
      map.setView([form.lat, form.lng], map.getZoom());
    }
  }, [form.lat, form.lng, map]);

  return form.lat != null && form.lng != null ? (
    <Marker
      position={[form.lat, form.lng]}
      icon={L.icon({
        iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
        iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
      })}
    />
  ) : null;
}

export default function PickupStepMap({ form, setForm }) {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const useCurrentLocation = () => {
    setLoading(true);
    setError(null);
    if (!navigator.geolocation) {
      setError('Geolokasi tidak didukung.');
      setLoading(false);
      return;
    }
    navigator.geolocation.getCurrentPosition(
      (pos) => {
        setForm((f) => ({
          ...f,
          lat: pos.coords.latitude,
          lng: pos.coords.longitude,
        }));
        setLoading(false);
      },
      () => {
        setError('Tidak dapat mengambil lokasi saat ini.');
        setLoading(false);
      }
    );
  };

  const defaultCenter = form.lat != null && form.lng != null
    ? [form.lat, form.lng]
    : [-6.2, 106.8];

  return (
    <div className="space-y-4">
      <button
        type="button"
        onClick={useCurrentLocation}
        disabled={loading}
        className="px-4 py-2 rounded-lg bg-[#8E24AA] text-white text-sm font-medium disabled:opacity-50"
      >
        {loading ? 'Mengambil lokasi...' : 'Gunakan Lokasi Saat Ini'}
      </button>
      {error && <p className="text-sm text-red-600">{error}</p>}
      <p className="text-sm text-gray-600">
        Klik pada peta untuk menandai lokasi penjemputan.
      </p>
      <div className="rounded-xl overflow-hidden border border-gray-200 h-[280px] bg-gray-100">
        <MapContainer
          center={defaultCenter}
          zoom={13}
          style={{ height: '100%', width: '100%' }}
          scrollWheelZoom
        >
          <TileLayer
            attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          />
          <LocationPicker form={form} setForm={setForm} />
        </MapContainer>
      </div>
      {form.lat != null && form.lng != null && (
        <p className="text-xs text-gray-500">
          Koordinat: {form.lat.toFixed(5)}, {form.lng.toFixed(5)}
        </p>
      )}
    </div>
  );
}
