import { NextResponse } from 'next/server'
import type { NextRequest } from 'next/server'

export function middleware(request: NextRequest) {
  const { pathname } = request.nextUrl

  if (pathname.startsWith('/crm')) {
    // TODO: Check session token
  }

  const response = NextResponse.next()
  response.headers.set('X-Powered-By', 'Immo Vision 17')

  return response
}

export const config = {
  matcher: [
    '/((?!_next/static|_next/image|favicon.ico|images|videos|fonts).*)',
  ],
}
