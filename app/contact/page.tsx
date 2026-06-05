import type { Metadata } from 'next'
import { ContactForm } from '@/components/contact/ContactForm'
import { MapPin, Phone, Mail, Clock, MessageCircle } from 'lucide-react'

export const metadata: Metadata = {
  title: 'Contact — Immo Vision 17',
  description: 'Contactez votre consultant immobilier en Charente-Maritime. Disponible 7j/7, réponse rapide.',
}

export default function ContactPage() {
  return (
    <div className="min-h-screen pt-24 pb-20">
      <div className="fixed inset-0 -z-10 bg-dark-900">
        <div className="absolute top-1/3 right-0 w-[600px] h-[600px] rounded-full bg-gold-500/4 blur-[100px]" />
      </div>
      <div className="container mx-auto px-6">
        <div className="text-center mb-16">
          <div className="inline-flex items-center gap-2 glass-gold rounded-full px-4 py-2 mb-6">
            <MessageCircle className="w-4 h-4 text-gold-400" />
            <span className="text-gold-400 text-sm font-medium">Contact</span>
          </div>
          <h1 className="font-display text-4xl md:text-6xl font-semibold text-white mb-4">
            Parlons de <span className="text-gold-gradient">votre projet</span>
          </h1>
          <p className="text-white/50 text-lg max-w-2xl mx-auto">
            Je suis disponible 7j/7 pour répondre à toutes vos questions et vous accompagner dans votre projet immobilier.
          </p>
        </div>
        <div className="grid lg:grid-cols-5 gap-12">
          <div className="lg:col-span-2 space-y-6">
            {[
              { icon: Phone, title: 'Téléphone', value: '06 XX XX XX XX', sub: 'Lun–Sam 9h–19h', href: 'tel:+33600000000' },
              { icon: Mail, title: 'Email', value: 'contact@immovision17.fr', sub: 'Réponse sous 4h', href: 'mailto:contact@immovision17.fr' },
              { icon: MapPin, title: "Zone d'intervention", value: 'Charente-Maritime (17)', sub: 'Royan · Saintes · Rochefort · La Rochelle', href: null },
              { icon: Clock, title: 'Disponibilité', value: '7 jours / 7', sub: 'Y compris week-end et jours fériés', href: null },
            ].map(({ icon: Icon, title, value, sub, href }) => (
              <div key={title} className="glass rounded-2xl p-5 flex items-start gap-4">
                <div className="w-11 h-11 rounded-xl glass-gold flex items-center justify-center flex-shrink-0">
                  <Icon className="w-5 h-5 text-gold-400" />
                </div>
                <div>
                  <p className="text-white/40 text-xs font-medium uppercase tracking-wider mb-0.5">{title}</p>
                  {href ? (
                    <a href={href} className="text-white font-semibold hover:text-gold-400 transition-colors">{value}</a>
                  ) : (
                    <p className="text-white font-semibold">{value}</p>
                  )}
                  <p className="text-white/40 text-sm mt-0.5">{sub}</p>
                </div>
              </div>
            ))}
          </div>
          <div className="lg:col-span-3 glass rounded-3xl p-8">
            <ContactForm />
          </div>
        </div>
      </div>
    </div>
  )
}
