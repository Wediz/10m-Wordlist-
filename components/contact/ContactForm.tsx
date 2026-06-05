'use client';

import { useState } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import { Send, CheckCircle } from 'lucide-react';
import toast from 'react-hot-toast';

const schema = z.object({
  firstName: z.string().min(2, 'Prénom requis'),
  lastName: z.string().min(2, 'Nom requis'),
  email: z.string().email('Email invalide'),
  phone: z.string().optional(),
  subject: z.string().min(1, 'Sujet requis'),
  message: z.string().min(10, 'Message trop court'),
});

type FormData = z.infer<typeof schema>;

const subjects = [
  { value: 'achat', label: 'Projet d\'achat' },
  { value: 'vente', label: 'Projet de vente' },
  { value: 'estimation', label: 'Estimation gratuite' },
  { value: 'visite', label: 'Demande de visite' },
  { value: 'investissement', label: 'Investissement locatif' },
  { value: 'autre', label: 'Autre demande' },
];

export default function ContactForm() {
  const [submitted, setSubmitted] = useState(false);

  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
  } = useForm<FormData>({ resolver: zodResolver(schema) });

  const onSubmit = async (data: FormData) => {
    try {
      const res = await fetch('/api/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
      });
      if (!res.ok) throw new Error();
      setSubmitted(true);
    } catch {
      toast.error('Une erreur est survenue. Veuillez réessayer.');
    }
  };

  if (submitted) {
    return (
      <div className="glass rounded-2xl p-12 text-center">
        <CheckCircle className="w-16 h-16 text-gold-400 mx-auto mb-4" />
        <h3 className="text-2xl font-bold text-white mb-2">Message envoyé !</h3>
        <p className="text-gray-400">Nous vous répondrons dans les plus brefs délais.</p>
      </div>
    );
  }

  return (
    <form onSubmit={handleSubmit(onSubmit)} className="glass rounded-2xl p-8 space-y-6">
      <div className="grid sm:grid-cols-2 gap-6">
        <div>
          <label className="text-gray-400 text-sm block mb-2">Prénom *</label>
          <input {...register('firstName')} className="input-premium w-full" placeholder="Jean" />
          {errors.firstName && <p className="text-red-400 text-xs mt-1">{errors.firstName.message}</p>}
        </div>
        <div>
          <label className="text-gray-400 text-sm block mb-2">Nom *</label>
          <input {...register('lastName')} className="input-premium w-full" placeholder="Dupont" />
          {errors.lastName && <p className="text-red-400 text-xs mt-1">{errors.lastName.message}</p>}
        </div>
      </div>

      <div className="grid sm:grid-cols-2 gap-6">
        <div>
          <label className="text-gray-400 text-sm block mb-2">Email *</label>
          <input {...register('email')} type="email" className="input-premium w-full" placeholder="jean@exemple.fr" />
          {errors.email && <p className="text-red-400 text-xs mt-1">{errors.email.message}</p>}
        </div>
        <div>
          <label className="text-gray-400 text-sm block mb-2">Téléphone</label>
          <input {...register('phone')} type="tel" className="input-premium w-full" placeholder="06 12 34 56 78" />
        </div>
      </div>

      <div>
        <label className="text-gray-400 text-sm block mb-2">Sujet *</label>
        <select {...register('subject')} className="input-premium w-full">
          <option value="">Choisissez un sujet</option>
          {subjects.map((s) => (
            <option key={s.value} value={s.value}>{s.label}</option>
          ))}
        </select>
        {errors.subject && <p className="text-red-400 text-xs mt-1">{errors.subject.message}</p>}
      </div>

      <div>
        <label className="text-gray-400 text-sm block mb-2">Message *</label>
        <textarea
          {...register('message')}
          rows={5}
          className="input-premium w-full resize-none"
          placeholder="Décrivez votre projet..."
        />
        {errors.message && <p className="text-red-400 text-xs mt-1">{errors.message.message}</p>}
      </div>

      <button type="submit" disabled={isSubmitting} className="btn-gold w-full flex items-center justify-center gap-2">
        <Send className="w-4 h-4" />
        {isSubmitting ? 'Envoi en cours...' : 'Envoyer le message'}
      </button>
    </form>
  );
}
