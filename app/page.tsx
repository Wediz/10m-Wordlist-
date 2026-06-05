import type { Metadata } from 'next'
import { HeroSection } from '@/components/home/HeroSection'
import { StatsSection } from '@/components/home/StatsSection'
import { ServicesSection } from '@/components/home/ServicesSection'
import { PromiseSection } from '@/components/home/PromiseSection'
import { FeaturedProperties } from '@/components/home/FeaturedProperties'
import { TestimonialsSection } from '@/components/home/TestimonialsSection'
import { CTASection } from '@/components/home/CTASection'
import { SEOSection } from '@/components/home/SEOSection'

export const metadata: Metadata = {
  title: 'Immo Vision 17 | Consultant Immobilier Premium — Charente-Maritime',
  description:
    'Estimez gratuitement votre bien en Charente-Maritime. Photos pro, drone 4K, visite virtuelle 360°, vidéo cinématique. Consultant indépendant Efficity.',
  alternates: { canonical: 'https://immovision17.fr' },
}

export default function HomePage() {
  return (
    <>
      <HeroSection />
      <StatsSection />
      <ServicesSection />
      <PromiseSection />
      <FeaturedProperties />
      <TestimonialsSection />
      <CTASection />
      <SEOSection />
    </>
  )
}
