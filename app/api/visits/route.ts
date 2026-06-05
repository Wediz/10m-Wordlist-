import { NextRequest, NextResponse } from 'next/server'
import { z } from 'zod'

const visitSchema = z.object({
  propertyId: z.string(),
  visitorName: z.string().min(2),
  visitorEmail: z.string().email(),
  visitorPhone: z.string().min(10),
  date: z.string(),
  notes: z.string().optional(),
})

export async function POST(req: NextRequest) {
  try {
    const body = await req.json()
    const data = visitSchema.parse(body)
    console.log('[VISIT] New visit request:', data.visitorName, data.date)
    return NextResponse.json({ success: true, message: 'Visit request created' }, { status: 201 })
  } catch (error) {
    if (error instanceof z.ZodError) {
      return NextResponse.json({ success: false, error: 'Validation error' }, { status: 400 })
    }
    return NextResponse.json({ success: false, error: 'Server error' }, { status: 500 })
  }
}
