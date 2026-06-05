'use client'

import { useState } from 'react'
import Link from 'next/link'
import { signIn } from 'next-auth/react'
import { useRouter } from 'next/navigation'
import { Mail, Lock, ArrowRight } from 'lucide-react'
import toast from 'react-hot-toast'

export default function LoginPage() {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [loading, setLoading] = useState(false)
  const router = useRouter()

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setLoading(true)
    const res = await signIn('credentials', { email, password, redirect: false })
    setLoading(false)
    if (res?.ok) {
      toast.success('Connexion réussie')
      router.push('/espace-vendeur')
    } else {
      toast.error('Identifiants invalides')
    }
  }

  return (
    <div className="min-h-screen bg-dark-900 flex items-center justify-center p-6">
      <div className="w-full max-w-md">
        <div className="text-center mb-10">
          <Link href="/" className="inline-flex items-center gap-3 mb-8">
            <div className="w-10 h-10 rounded-xl bg-gradient-gold flex items-center justify-center shadow-gold">
              <span className="font-display font-bold text-dark-900">IV</span>
            </div>
            <span className="font-display font-semibold text-white text-xl">Immo Vision 17</span>
          </Link>
          <h1 className="font-display text-3xl font-semibold text-white">Connexion</h1>
          <p className="text-white/40 mt-2">Accédez à votre espace personnel</p>
        </div>
        <div className="glass rounded-2xl p-8">
          <form onSubmit={handleSubmit} className="space-y-4">
            <div>
              <label className="block text-white/55 text-sm font-medium mb-1.5">
                <Mail className="inline w-3.5 h-3.5 mr-1" />Email
              </label>
              <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="votre@email.fr" required className="input-premium w-full px-4 py-3 rounded-xl text-sm" />
            </div>
            <div>
              <label className="block text-white/55 text-sm font-medium mb-1.5">
                <Lock className="inline w-3.5 h-3.5 mr-1" />Mot de passe
              </label>
              <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} placeholder="••••••••" required className="input-premium w-full px-4 py-3 rounded-xl text-sm" />
            </div>
            <button type="submit" disabled={loading} className="btn-gold w-full py-4 rounded-xl font-semibold flex items-center justify-center gap-2 disabled:opacity-50 mt-2">
              {loading ? <span className="loader w-5 h-5" /> : <><ArrowRight className="w-4 h-4" /> Se connecter</>}
            </button>
          </form>
        </div>
        <p className="text-center text-white/25 text-sm mt-6">
          Pas encore de compte ?{' '}
          <Link href="/contact" className="text-gold-400 hover:text-gold-300">Contactez-nous</Link>
        </p>
      </div>
    </div>
  )
}
