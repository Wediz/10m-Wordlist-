'use client';

import { useState } from 'react';
import Image from 'next/image';
import { X, ChevronLeft, ChevronRight } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';

interface GalleryImage {
  url: string;
  alt: string;
}

interface PropertyGalleryProps {
  images: GalleryImage[];
  title: string;
}

export default function PropertyGallery({ images, title }: PropertyGalleryProps) {
  const [lightbox, setLightbox] = useState<number | null>(null);

  const prev = () => setLightbox((p) => (p !== null ? (p - 1 + images.length) % images.length : null));
  const next = () => setLightbox((p) => (p !== null ? (p + 1) % images.length : null));

  return (
    <>
      <div className="grid grid-cols-4 grid-rows-2 gap-3 h-[480px] rounded-2xl overflow-hidden">
        {images.slice(0, 5).map((img, i) => (
          <div
            key={i}
            className={`relative cursor-pointer overflow-hidden group ${
              i === 0 ? 'col-span-2 row-span-2' : ''
            }`}
            onClick={() => setLightbox(i)}
          >
            <Image
              src={img.url}
              alt={img.alt || `${title} - photo ${i + 1}`}
              fill
              className="object-cover group-hover:scale-105 transition-transform duration-500"
            />
            {i === 4 && images.length > 5 && (
              <div className="absolute inset-0 bg-black/60 flex items-center justify-center">
                <span className="text-white text-xl font-bold">+{images.length - 5}</span>
              </div>
            )}
          </div>
        ))}
      </div>

      <AnimatePresence>
        {lightbox !== null && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-50 bg-black/95 flex items-center justify-center"
            onClick={() => setLightbox(null)}
          >
            <button
              className="absolute top-4 right-4 text-white/70 hover:text-white"
              onClick={() => setLightbox(null)}
            >
              <X className="w-8 h-8" />
            </button>
            <button
              className="absolute left-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white"
              onClick={(e) => { e.stopPropagation(); prev(); }}
            >
              <ChevronLeft className="w-10 h-10" />
            </button>
            <div className="relative w-full max-w-5xl h-[80vh] px-20" onClick={(e) => e.stopPropagation()}>
              <Image
                src={images[lightbox].url}
                alt={images[lightbox].alt}
                fill
                className="object-contain"
              />
            </div>
            <button
              className="absolute right-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white"
              onClick={(e) => { e.stopPropagation(); next(); }}
            >
              <ChevronRight className="w-10 h-10" />
            </button>
            <div className="absolute bottom-6 flex gap-2">
              {images.map((_, i) => (
                <button
                  key={i}
                  onClick={(e) => { e.stopPropagation(); setLightbox(i); }}
                  className={`w-2 h-2 rounded-full transition-all ${
                    i === lightbox ? 'bg-gold-400 w-6' : 'bg-white/30'
                  }`}
                />
              ))}
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
