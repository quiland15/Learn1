import React from 'react';
import { format } from 'date-fns';
import { id } from 'date-fns/locale';

export default function UserManagement({ users }) {
  if (!users || users.length === 0) {
    return (
      <div className="rounded-xl border border-gray-200 bg-white p-6 text-gray-500 text-sm">
        Belum ada nasabah terdaftar.
      </div>
    );
  }

  return (
    <div className="rounded-xl border border-gray-200 bg-white overflow-hidden shadow-sm">
      <div className="overflow-x-auto">
        <table className="min-w-full divide-y divide-gray-200">
          <thead className="bg-gray-50">
            <tr>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Nama
              </th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Email
              </th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Saldo Tabungan (Rp)
              </th>
              <th className="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                Terdaftar
              </th>
            </tr>
          </thead>
          <tbody className="divide-y divide-gray-200">
            {users.map((u) => (
              <tr key={u.id} className="bg-white hover:bg-gray-50">
                <td className="px-4 py-3 font-medium text-gray-900">{u.name}</td>
                <td className="px-4 py-3 text-gray-600">{u.email}</td>
                <td className="px-4 py-3 font-semibold text-[#1E5631]">
                  Rp {Number(u.balance ?? 0).toLocaleString('id-ID')}
                </td>
                <td className="px-4 py-3 text-sm text-gray-500">
                  {u.created_at
                    ? format(new Date(u.created_at), 'd MMM yyyy', {
                        locale: id,
                      })
                    : '–'}
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}
