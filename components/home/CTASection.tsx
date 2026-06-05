import Link from 'next/link';
import { Phone } from 'lucide-react';

export default function CTASection() {
  return (
    <section className="py-24 bg-dark-950 relative overflow-hidden">
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(212,175,55,0.1)_0%,transparent_70%)]" />
      <div className="container mx-auto px-4 text-center relative z-10">
        <h2 className="text-4xl md:text-5xl font-bold text-white mb-6">
          Prêt à vendre votre bien
          <br />
          <span className="text-gradient">au meilleur prix ?</span>
        </h2>
        <p className="text-gray-400 text-xl mb-10 max-w-2xl mx-auto">
          Obtenez une estimation gratuite et découvrez comment nous pouvons vendre votre bien plus
          vite et plus cher grâce à notre méthode premium.
        </p>
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
          <Link href="/estimation" className="btn-gold text-base px-10 py-4">
            Estimation gratuite
          </Link>
          <a
            href={`tel:${process.env.NEXT_PUBLIC_AGENT_PHONE || '0612345678'}`}
            className="btn-outline text-base px-10 py-4 flex items-center gap-2"
          >
            <Phone className="w-4 h-4" />
            Appeler maintenant
          </a>
        </div>
      </div>
    </section>
  );
}
