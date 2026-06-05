import { NextRequest, NextResponse } from 'next/server'
import { z } from 'zod'

const contactSchema = z.object({
  name: z.string().min(2),
  email: z.string().email(),
  phone: z.string().optional(),
  subject: z.string().min(3),
  message: z.string().min(20),
})

export async function POST(req: NextRequest) {
  try {
    const body = await req.json()
    const data = contactSchema.parse(body)
    // TODO: Save to database + send email via Resend
    console.log('[CONTACT] New message from:', data.name, data.email)
    return NextResponse.json({ success: true, message: 'Message received' }, { status: 201 })
  } catch (error) {
    if (error instanceof z.ZodError) {
      return NextResponse.json({ success: false, error: 'Validation error' }, { status: 400 })
    }
    return NextResponse.json({ success: false, error: 'Internal server error' }, { status: 500 })
  }
}
