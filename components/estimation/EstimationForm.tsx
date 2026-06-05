'use client';

import { useState } from 'react';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import { z } from 'zod';
import { motion, AnimatePresence } from 'framer-motion';
import { CheckCircle, ChevronRight, ChevronLeft } from 'lucide-react';
import toast from 'react-hot-toast';
import { PROPERTY_TYPES, SEO_CITIES } from '@/lib/constants';

const schema = z.object({
  propertyType: z.string().min(1),
  city: z.string().min(1),
  address: z.string().min(5),
  postalCode: z.string().length(5),
  surface: z.coerce.number().min(10),
  rooms: z.coerce.number().min(1),
  condition: z.string().min(1),
  hasPool: z.boolean().optional(),
  hasGarage: z.boolean().optional(),
  hasGarden: z.boolean().optional(),
  firstName: z.string().min(2),
  lastName: z.string().min(2),
  email: z.string().email(),
  phone: z.string().min(10),
});

type FormData = z.infer<typeof schema>;

const steps = [
  { title: 'Votre bien', fields: ['propertyType', 'city', 'address', 'postalCode'] },
  { title: 'Caractéristiques', fields: ['surface', 'rooms', 'condition'] },
  { title: 'Prestations', fields: ['hasPool', 'hasGarage', 'hasGarden'] },
  { title: 'Vos coordonnées', fields: ['firstName', 'lastName', 'email', 'phone'] },
];

export default function EstimationForm() {
  const [step, setStep] = useState(0);
  const [submitted, setSubmitted] = useState(false);

  const {
    register,
    handleSubmit,
    trigger,
    formState: { errors, isSubmitting },
  } = useForm<FormData>({ resolver: zodResolver(schema) });

  const nextStep = async () => {
    const fields = steps[step].fields as (keyof FormData)[];
    const valid = await trigger(fields);
    if (valid) setStep((s) => s + 1);
  };

  const onSubmit = async (data: FormData) => {
    try {
      const res = await fetch('/api/estimation', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
      });
      if (!res.ok) throw new Error();
      setSubmitted(true);
    } catch {
      toast.error('Une erreur est survenue.');
    }
  };

  if (submitted) {
    return (
      <motion.div
        initial={{ scale: 0.9, opacity: 0 }}
        animate={{ scale: 1, opacity: 1 }}
        className="glass-gold rounded-3xl p-12 text-center"
      >
        <CheckCircle className="w-20 h-20 text-gold-400 mx-auto mb-6" />
        <h3 className="text-3xl font-bold text-white mb-3">Demande envoyée !</h3>
        <p className="text-gray-300 text-lg">
          Votre estimation sera prête sous <strong className="text-gold-400">48h</strong>.
        </p>
        <p className="text-gray-400 mt-2">Nous vous contacterons par téléphone pour en discuter.</p>
      </motion.div>
    );
  }

  return (
    <div className="glass rounded-3xl p-8">
      {/* Progress */}
      <div className="mb-8">
        <div className="flex items-center justify-between mb-3">
          {steps.map((s, i) => (
            <div
              key={i}
              className={`flex items-center gap-2 text-sm ${
                i <= step ? 'text-gold-400' : 'text-gray-600'
              }`}
            >
              <div
                className={`w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold ${
                  i < step
                    ? 'bg-gold-400 text-dark-950'
                    : i === step
                    ? 'border-2 border-gold-400 text-gold-400'
                    : 'border-2 border-white/10 text-gray-600'
                }`}
              >
                {i < step ? '✓' : i + 1}
              </div>
              <span className="hidden sm:block">{s.title}</span>
            </div>
          ))}
        </div>
        <div className="progress-bar h-1 bg-white/10 rounded-full overflow-hidden">
          <div
            className="h-full bg-gradient-to-r from-gold-600 to-gold-400 transition-all duration-500"
            style={{ width: `${((step + 1) / steps.length) * 100}%` }}
          />
        </div>
      </div>

      <form onSubmit={handleSubmit(onSubmit)}>
        <AnimatePresence mode="wait">
          <motion.div
            key={step}
            initial={{ opacity: 0, x: 20 }}
            animate={{ opacity: 1, x: 0 }}
            exit={{ opacity: 0, x: -20 }}
            className="space-y-6 min-h-[280px]"
          >
            {step === 0 && (
              <>
                <div>
                  <label className="text-gray-400 text-sm block mb-2">Type de bien *</label>
                  <select {...register('propertyType')} className="input-premium w-full">
                    <option value="">Sélectionnez</option>
                    {PROPERTY_TYPES.map((t) => (
                      <option key={t.value} value={t.value}>{t.label}</option>
                    ))}
                  </select>
                  {errors.propertyType && <p className="text-red-400 text-xs mt-1">Requis</p>}
                </div>
                <div>
                  <label className="text-gray-400 text-sm block mb-2">Ville *</label>
                  <select {...register('city')} className="input-premium w-full">
                    <option value="">Sélectionnez</option>
                    {SEO_CITIES.map((c) => (
                      <option key={c.slug} value={c.name}>{c.name}</option>
                    ))}
                  </select>
                  {errors.city && <p className="text-red-400 text-xs mt-1">Requis</p>}
                </div>
                <div>
                  <label className="text-gray-400 text-sm block mb-2">Adresse *</label>
                  <input {...register('address')} className="input-premium w-full" placeholder="12 rue de la Paix" />
                  {errors.address && <p className="text-red-400 text-xs mt-1">Adresse requise</p>}
                </div>
                <div>
                  <label className="text-gray-400 text-sm block mb-2">Code postal *</label>
                  <input {...register('postalCode')} className="input-premium w-full" placeholder="17000" />
                  {errors.postalCode && <p className="text-red-400 text-xs mt-1">Code postal invalide</p>}
                </div>
              </>
            )}

            {step === 1 && (
              <>
                <div>
                  <label className="text-gray-400 text-sm block mb-2">Surface (m²) *</label>
                  <input {...register('surface')} type="number" className="input-premium w-full" placeholder="120" />
                  {errors.surface && <p className="text-red-400 text-xs mt-1">Surface requise</p>}
                </div>
                <div>
                  <label className="text-gray-400 text-sm block mb-2">Nombre de pièces *</label>
                  <input {...register('rooms')} type="number" className="input-premium w-full" placeholder="5" />
                  {errors.rooms && <p className="text-red-400 text-xs mt-1">Requis</p>}
                </div>
                <div>
                  <label className="text-gray-400 text-sm block mb-2">État général *</label>
                  <select {...register('condition')} className="input-premium w-full">
                    <option value="">Sélectionnez</option>
                    <option value="neuf">Neuf / Très bon état</option>
                    <option value="bon">Bon état</option>
                    <option value="moyen">À rénover partiellement</option>
                    <option value="travaux">À rénover entièrement</option>
                  </select>
                  {errors.condition && <p className="text-red-400 text-xs mt-1">Requis</p>}
                </div>
              </>
            )}

            {step === 2 && (
              <div className="space-y-4">
                <p className="text-gray-400">Sélectionnez les prestations de votre bien :</p>
                {[
                  { key: 'hasPool', label: 'Piscine' },
                  { key: 'hasGarage', label: 'Garage / Box' },
                  { key: 'hasGarden', label: 'Jardin' },
                ].map(({ key, label }) => (
                  <label key={key} className="flex items-center gap-3 cursor-pointer glass rounded-xl p-4">
                    <input
                      type="checkbox"
                      {...register(key as keyof FormData)}
                      className="w-5 h-5 accent-gold-400"
                    />
                    <span className="text-gray-300">{label}</span>
                  </label>
                ))}
              </div>
            )}

            {step === 3 && (
              <>
                <div className="grid sm:grid-cols-2 gap-4">
                  <div>
                    <label className="text-gray-400 text-sm block mb-2">Prénom *</label>
                    <input {...register('firstName')} className="input-premium w-full" placeholder="Jean" />
                    {errors.firstName && <p className="text-red-400 text-xs mt-1">Requis</p>}
                  </div>
                  <div>
                    <label className="text-gray-400 text-sm block mb-2">Nom *</label>
                    <input {...register('lastName')} className="input-premium w-full" placeholder="Dupont" />
                    {errors.lastName && <p className="text-red-400 text-xs mt-1">Requis</p>}
                  </div>
                </div>
                <div>
                  <label className="text-gray-400 text-sm block mb-2">Email *</label>
                  <input {...register('email')} type="email" className="input-premium w-full" placeholder="jean@exemple.fr" />
                  {errors.email && <p className="text-red-400 text-xs mt-1">Email invalide</p>}
                </div>
                <div>
                  <label className="text-gray-400 text-sm block mb-2">Téléphone *</label>
                  <input {...register('phone')} type="tel" className="input-premium w-full" placeholder="06 12 34 56 78" />
                  {errors.phone && <p className="text-red-400 text-xs mt-1">Téléphone requis</p>}
                </div>
              </>
            )}
          </motion.div>
        </AnimatePresence>

        <div className="flex items-center justify-between mt-8 pt-6 border-t border-white/10">
          {step > 0 ? (
            <button
              type="button"
              onClick={() => setStep((s) => s - 1)}
              className="btn-outline flex items-center gap-2"
            >
              <ChevronLeft className="w-4 h-4" /> Retour
            </button>
          ) : (
            <div />
          )}

          {step < steps.length - 1 ? (
            <button
              type="button"
              onClick={nextStep}
              className="btn-gold flex items-center gap-2"
            >
              Continuer <ChevronRight className="w-4 h-4" />
            </button>
          ) : (
            <button
              type="submit"
              disabled={isSubmitting}
              className="btn-gold flex items-center gap-2"
            >
              {isSubmitting ? 'Envoi...' : 'Obtenir mon estimation'}
            </button>
          )}
        </div>
      </form>
    </div>
  );
}
