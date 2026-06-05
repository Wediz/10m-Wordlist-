'use client';

import { useState, useEffect } from 'react';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import { motion, AnimatePresence } from 'framer-motion';
import { Menu, X, ChevronDown, Phone } from 'lucide-react';
import { cn } from '@/lib/utils';

const navLinks = [
  { label: 'Accueil', href: '/' },
  {
    label: 'Nos Biens',
    href: '/biens',
    children: [
      { label: 'Toutes les annonces', href: '/biens' },
      { label: 'Maisons', href: '/biens?type=maison' },
      { label: 'Appartements', href: '/biens?type=appartement' },
      { label: 'Châteaux & Propriétés', href: '/biens?type=chateau' },
      { label: 'Terrains', href: '/biens?type=terrain' },
    ],
  },
  {
    label: 'Services',
    href: '#services',
    children: [
      { label: 'Estimation gratuite', href: '/estimation' },
      { label: 'Vendre avec nous', href: '/espace-vendeur' },
      { label: 'Acheter', href: '/espace-acheteur' },
      { label: 'Visite virtuelle 360°', href: '/biens' },
    ],
  },
  { label: 'Blog', href: '/blog' },
  { label: 'Contact', href: '/contact' },
];

export default function Navbar() {
  const [scrolled, setScrolled] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);
  const [activeDropdown, setActiveDropdown] = useState<string | null>(null);
  const pathname = usePathname();

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  useEffect(() => {
    setMobileOpen(false);
  }, [pathname]);

  return (
    <header
      className={cn(
        'fixed top-0 left-0 right-0 z-50 transition-all duration-500',
        scrolled
          ? 'bg-dark-950/95 backdrop-blur-xl border-b border-gold-900/30 shadow-gold'
          : 'bg-transparent'
      )}
    >
      <nav className="container mx-auto px-4 h-20 flex items-center justify-between">
        {/* Logo */}
        <Link href="/" className="flex items-center gap-3 group">
          <div className="w-10 h-10 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center shadow-gold">
            <span className="text-dark-950 font-bold text-sm">IV</span>
          </div>
          <div>
            <div className="text-white font-bold text-lg leading-none group-hover:text-gold-400 transition-colors">
              Immo Vision 17
            </div>
            <div className="text-gold-500 text-xs">Charente-Maritime</div>
          </div>
        </Link>

        {/* Desktop Nav */}
        <div className="hidden lg:flex items-center gap-1">
          {navLinks.map((link) => (
            <div
              key={link.label}
              className="relative"
              onMouseEnter={() => link.children && setActiveDropdown(link.label)}
              onMouseLeave={() => setActiveDropdown(null)}
            >
              <Link
                href={link.href}
                className={cn(
                  'flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200',
                  pathname === link.href
                    ? 'text-gold-400'
                    : 'text-gray-300 hover:text-white hover:bg-white/5'
                )}
              >
                {link.label}
                {link.children && <ChevronDown className="w-3 h-3" />}
              </Link>

              <AnimatePresence>
                {link.children && activeDropdown === link.label && (
                  <motion.div
                    initial={{ opacity: 0, y: 8 }}
                    animate={{ opacity: 1, y: 0 }}
                    exit={{ opacity: 0, y: 8 }}
                    transition={{ duration: 0.15 }}
                    className="absolute top-full left-0 mt-1 w-56 glass rounded-xl overflow-hidden shadow-xl border border-gold-900/30"
                  >
                    {link.children.map((child) => (
                      <Link
                        key={child.href}
                        href={child.href}
                        className="block px-4 py-3 text-sm text-gray-300 hover:text-gold-400 hover:bg-white/5 transition-colors"
                      >
                        {child.label}
                      </Link>
                    ))}
                  </motion.div>
                )}
              </AnimatePresence>
            </div>
          ))}
        </div>

        {/* CTA */}
        <div className="hidden lg:flex items-center gap-3">
          <a
            href={`tel:${process.env.NEXT_PUBLIC_AGENT_PHONE || '0612345678'}`}
            className="flex items-center gap-2 text-gold-400 hover:text-gold-300 text-sm font-medium transition-colors"
          >
            <Phone className="w-4 h-4" />
            <span>{process.env.NEXT_PUBLIC_AGENT_PHONE || '06 12 34 56 78'}</span>
          </a>
          <Link href="/estimation" className="btn-gold text-sm px-5 py-2">
            Estimation gratuite
          </Link>
        </div>

        {/* Mobile toggle */}
        <button
          className="lg:hidden text-white p-2"
          onClick={() => setMobileOpen(!mobileOpen)}
          aria-label="Toggle menu"
        >
          {mobileOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
        </button>
      </nav>

      {/* Mobile Menu */}
      <AnimatePresence>
        {mobileOpen && (
          <motion.div
            initial={{ opacity: 0, height: 0 }}
            animate={{ opacity: 1, height: 'auto' }}
            exit={{ opacity: 0, height: 0 }}
            className="lg:hidden bg-dark-950/98 backdrop-blur-xl border-t border-gold-900/30 overflow-hidden"
          >
            <div className="px-4 py-6 space-y-2">
              {navLinks.map((link) => (
                <div key={link.label}>
                  <Link
                    href={link.href}
                    className="block px-4 py-3 text-gray-300 hover:text-gold-400 font-medium rounded-lg hover:bg-white/5 transition-colors"
                  >
                    {link.label}
                  </Link>
                  {link.children && (
                    <div className="pl-4 mt-1 space-y-1">
                      {link.children.map((child) => (
                        <Link
                          key={child.href}
                          href={child.href}
                          className="block px-4 py-2 text-sm text-gray-400 hover:text-gold-400 transition-colors"
                        >
                          {child.label}
                        </Link>
                      ))}
                    </div>
                  )}
                </div>
              ))}
              <div className="pt-4 border-t border-white/10">
                <Link href="/estimation" className="btn-gold w-full text-center block">
                  Estimation gratuite
                </Link>
              </div>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </header>
  );
}
