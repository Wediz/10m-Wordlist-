import { NextRequest, NextResponse } from 'next/server'

export async function GET(req: NextRequest, { params }: { params: { slug: string } }) {
  try {
    // TODO: Fetch from DB and increment view count
    return NextResponse.json({ success: true, data: null })
  } catch {
    return NextResponse.json({ success: false, error: 'Server error' }, { status: 500 })
  }
}
