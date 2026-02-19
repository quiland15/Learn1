import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import App from './dashboard/App';

const el = document.getElementById('dashboard-root');
if (!el) throw new Error('dashboard-root not found');

let initial = {};
try {
  const raw = el.getAttribute('data-initial');
  if (raw) initial = JSON.parse(raw);
} catch (_) {}

const root = createRoot(el);
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <App initial={initial} />
    </BrowserRouter>
  </React.StrictMode>
);
