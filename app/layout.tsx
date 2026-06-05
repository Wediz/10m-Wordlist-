import type { Metadata } from 'next'
import { Inter, Playfair_Display } from 'next/font/google'
import './globals.css'
import { Navbar } from '@/components/layout/Navbar'
import { Footer } from '@/components/layout/Footer'
import { Toaster } from 'react-hot-toast'

const inter = Inter({
  subsets: ['latin'],
  variable: '--font-inter',
  display: 'swap',
})

const playfair = Playfair_Display({
  subsets: ['latin'],
  variable: '--font-playfair',
  display: 'swap',
})

export const metadata: Metadata = {
  title: {
    default: 'Immo Vision 17 | Consultant Immobilier Premium — Charente-Maritime',
    template: '%s | Immo Vision 17',
  },
  description:
    'Consultant immobilier indépendant en Charente-Maritime. Photos professionnelles, drone 4K, visite virtuelle 360°, vidéo cinématique. Estimez votre bien gratuitement.',
  keywords: [
    'immobilier Royan',
    'immobilier Rochefort',
    'immobilier Saintes',
    'immobilier La Rochelle',
    'immobilier Charente-Maritime',
    'consultant immobilier',
    'estimation immobilière gratuite',
    'vente maison Charente-Maritime',
    'drone immobilier',
    'visite virtuelle 360',
    'Efficity',
    'mandat exclusif immobilier',
  ],
  authors: [{ name: 'Immo Vision 17' }],
  creator: 'Immo Vision 17',
  metadataBase: new URL('https://immovision17.fr'),
  openGraph: {
    type: 'website',
    locale: 'fr_FR',
    url: 'https://immovision17.fr',
    siteName: 'Immo Vision 17',
    title: 'Immo Vision 17 | Consultant Immobilier Premium — Charente-Maritime',
    description:
      "Votre bien mérite plus qu'une simple annonce. Photos pro, drone, visite 360°, vidéo cinéma.",
    images: [{ url: '/og-image.jpg', width: 1200, height: 630, alt: 'Immo Vision 17' }],
  },
  twitter: {
    card: 'summary_large_image',
    title: 'Immo Vision 17 | Consultant Immobilier Premium',
    description: "Votre bien mérite plus qu'une simple annonce.",
    images: ['/og-image.jpg'],
  },
  robots: {
    index: true,
    follow: true,
    googleBot: {
      index: true,
      follow: true,
      'max-video-preview': -1,
      'max-image-preview': 'large',
      'max-snippet': -1,
    },
  },
  alternates: { canonical: 'https://immovision17.fr' },
}

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="fr" className={`${inter.variable} ${playfair.variable}`}>
      <head>
        <link rel="icon" href="/favicon.ico" sizes="any" />
        <link rel="icon" href="/icon.svg" type="image/svg+xml" />
        <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
        <link rel="manifest" href="/manifest.json" />
        <meta name="theme-color" content="#0A0A0A" />
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <script
          type="application/ld+json"
          dangerouslySetInnerHTML={{
            __html: JSON.stringify({
              '@context': 'https://schema.org',
              '@type': 'RealEstateAgent',
              name: 'Immo Vision 17',
              description: 'Consultant immobilier premium en Charente-Maritime',
              url: 'https://immovision17.fr',
              telephone: process.env.NEXT_PUBLIC_AGENT_PHONE,
              email: process.env.NEXT_PUBLIC_AGENT_EMAIL,
              areaServed: ['Royan', 'Rochefort', 'Saintes', 'La Rochelle', 'Charente-Maritime'],
              memberOf: { '@type': 'Organization', name: 'Efficity' },
            }),
          }}
        />
      </head>
      <body className="bg-dark-900 text-white font-sans antialiased">
        <Navbar />
        <main>{children}</main>
        <Footer />
        <Toaster
          position="bottom-right"
          toastOptions={{
            duration: 4000,
            style: {
              background: '#141414',
              color: '#fff',
              border: '1px solid rgba(201,168,76,0.25)',
              borderRadius: '12px',
              fontSize: '14px',
            },
            success: { iconTheme: { primary: '#C9A84C', secondary: '#0A0A0A' } },
          }}
        />
      </body>
    </html>
  )
}
