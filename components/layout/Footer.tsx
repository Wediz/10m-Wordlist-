import Link from 'next/link';
import { Phone, Mail, MapPin, Facebook, Instagram, Linkedin, Youtube } from 'lucide-react';
import { SEO_CITIES, SOCIAL_LINKS } from '@/lib/constants';

export default function Footer() {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="bg-dark-950 border-t border-gold-900/30">
      <div className="container mx-auto px-4 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
          {/* Brand */}
          <div className="space-y-4">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center">
                <span className="text-dark-950 font-bold text-sm">IV</span>
              </div>
              <div>
                <div className="text-white font-bold text-lg leading-none">Immo Vision 17</div>
                <div className="text-gold-500 text-xs">Charente-Maritime</div>
              </div>
            </div>
            <p className="text-gray-400 text-sm leading-relaxed">
              Consultant immobilier indépendant en Charente-Maritime. Expert local pour vos projets d'achat,
              vente et estimation immobilière.
            </p>
            <div className="space-y-2">
              <a
                href={`tel:${process.env.NEXT_PUBLIC_AGENT_PHONE || '0612345678'}`}
                className="flex items-center gap-2 text-sm text-gray-400 hover:text-gold-400 transition-colors"
              >
                <Phone className="w-4 h-4 text-gold-500" />
                {process.env.NEXT_PUBLIC_AGENT_PHONE || '06 12 34 56 78'}
              </a>
              <a
                href={`mailto:${process.env.NEXT_PUBLIC_AGENT_EMAIL || 'contact@immovision17.fr'}`}
                className="flex items-center gap-2 text-sm text-gray-400 hover:text-gold-400 transition-colors"
              >
                <Mail className="w-4 h-4 text-gold-500" />
                {process.env.NEXT_PUBLIC_AGENT_EMAIL || 'contact@immovision17.fr'}
              </a>
              <div className="flex items-center gap-2 text-sm text-gray-400">
                <MapPin className="w-4 h-4 text-gold-500" />
                Charente-Maritime (17)
              </div>
            </div>
            {/* Social */}
            <div className="flex items-center gap-3 pt-2">
              <a href={SOCIAL_LINKS.facebook} target="_blank" rel="noopener noreferrer" className="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-gold-900/50 hover:text-gold-400 text-gray-400 transition-all">
                <Facebook className="w-4 h-4" />
              </a>
              <a href={SOCIAL_LINKS.instagram} target="_blank" rel="noopener noreferrer" className="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-gold-900/50 hover:text-gold-400 text-gray-400 transition-all">
                <Instagram className="w-4 h-4" />
              </a>
              <a href={SOCIAL_LINKS.linkedin} target="_blank" rel="noopener noreferrer" className="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-gold-900/50 hover:text-gold-400 text-gray-400 transition-all">
                <Linkedin className="w-4 h-4" />
              </a>
              <a href={SOCIAL_LINKS.youtube} target="_blank" rel="noopener noreferrer" className="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-gold-900/50 hover:text-gold-400 text-gray-400 transition-all">
                <Youtube className="w-4 h-4" />
              </a>
            </div>
          </div>

          {/* Services */}
          <div>
            <h3 className="text-white font-semibold mb-4">Nos Services</h3>
            <ul className="space-y-2">
              {[
                { label: 'Estimation gratuite', href: '/estimation' },
                { label: 'Vendre votre bien', href: '/espace-vendeur' },
                { label: 'Trouver un bien', href: '/biens' },
                { label: 'Visite virtuelle 360°', href: '/biens' },
                { label: 'Espace acheteur', href: '/espace-acheteur' },
                { label: 'Blog immobilier', href: '/blog' },
                { label: 'Nous contacter', href: '/contact' },
              ].map((item) => (
                <li key={item.href}>
                  <Link
                    href={item.href}
                    className="text-sm text-gray-400 hover:text-gold-400 transition-colors"
                  >
                    {item.label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Cities */}
          <div>
            <h3 className="text-white font-semibold mb-4">Nos secteurs</h3>
            <ul className="space-y-2">
              {SEO_CITIES.map((city) => (
                <li key={city.slug}>
                  <Link
                    href={`/immobilier-${city.slug}`}
                    className="text-sm text-gray-400 hover:text-gold-400 transition-colors"
                  >
                    Immobilier {city.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          {/* Legal + Badge */}
          <div>
            <h3 className="text-white font-semibold mb-4">Informations</h3>
            <ul className="space-y-2 mb-6">
              {[
                { label: 'Mentions légales', href: '/mentions-legales' },
                { label: 'Politique de confidentialité', href: '/mentions-legales' },
                { label: 'CGU', href: '/mentions-legales' },
              ].map((item) => (
                <li key={item.label}>
                  <Link
                    href={item.href}
                    className="text-sm text-gray-400 hover:text-gold-400 transition-colors"
                  >
                    {item.label}
                  </Link>
                </li>
              ))}
            </ul>
            <div className="glass rounded-xl p-4 text-center">
              <div className="text-gold-400 text-xs font-semibold mb-1">Réseau Efficity</div>
              <div className="text-gray-400 text-xs">Agent mandataire immobilier</div>
              <div className="text-gray-500 text-xs mt-1">Carte pro n° XXXXX</div>
            </div>
          </div>
        </div>
      </div>

      <div className="border-t border-white/5 py-6">
        <div className="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
          <p className="text-gray-500 text-sm">
            &copy; {currentYear} Immo Vision 17. Tous droits réservés.
          </p>
          <p className="text-gray-600 text-xs">
            Site créé avec passion pour l'immobilier en Charente-Maritime
          </p>
        </div>
      </div>
    </footer>
  );
}
