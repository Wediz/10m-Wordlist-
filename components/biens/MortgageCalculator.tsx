'use client';

import { useState } from 'react';
import { calculateMonthlyPayment, formatPrice } from '@/lib/utils';

interface MortgageCalculatorProps {
  propertyPrice: number;
}

export default function MortgageCalculator({ propertyPrice }: MortgageCalculatorProps) {
  const [downPayment, setDownPayment] = useState(Math.round(propertyPrice * 0.1));
  const [rate, setRate] = useState(3.8);
  const [years, setYears] = useState(20);

  const monthly = calculateMonthlyPayment(propertyPrice, downPayment, rate, years);
  const totalCost = monthly * years * 12;
  const interestCost = totalCost - (propertyPrice - downPayment);

  return (
    <div className="glass rounded-2xl p-6">
      <h3 className="text-white font-semibold mb-6">Simulateur de prêt</h3>

      <div className="space-y-4 mb-6">
        <div>
          <div className="flex justify-between text-sm mb-2">
            <span className="text-gray-400">Apport personnel</span>
            <span className="text-gold-400 font-medium">{formatPrice(downPayment)}</span>
          </div>
          <input
            type="range"
            min={0}
            max={propertyPrice * 0.5}
            step={5000}
            value={downPayment}
            onChange={(e) => setDownPayment(Number(e.target.value))}
            className="w-full accent-gold-400"
          />
        </div>

        <div>
          <div className="flex justify-between text-sm mb-2">
            <span className="text-gray-400">Taux d\'intérêt</span>
            <span className="text-gold-400 font-medium">{rate}%</span>
          </div>
          <input
            type="range"
            min={1}
            max={6}
            step={0.1}
            value={rate}
            onChange={(e) => setRate(Number(e.target.value))}
            className="w-full accent-gold-400"
          />
        </div>

        <div>
          <div className="flex justify-between text-sm mb-2">
            <span className="text-gray-400">Durée</span>
            <span className="text-gold-400 font-medium">{years} ans</span>
          </div>
          <input
            type="range"
            min={5}
            max={30}
            step={1}
            value={years}
            onChange={(e) => setYears(Number(e.target.value))}
            className="w-full accent-gold-400"
          />
        </div>
      </div>

      <div className="glass-gold rounded-xl p-4 text-center">
        <div className="text-3xl font-bold text-gradient mb-1">
          {formatPrice(monthly)}<span className="text-sm text-gray-400">/mois</span>
        </div>
        <div className="text-gray-400 text-xs">
          Coût total des intérêts : {formatPrice(interestCost)}
        </div>
      </div>
    </div>
  );
}
