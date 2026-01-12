import { NextRequest, NextResponse } from 'next/server';

const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

// Force dynamic rendering to prevent Next.js from caching this route
export const dynamic = 'force-dynamic';
export const revalidate = 0;

export async function GET(request: NextRequest) {
  try {
    // Fetch favicon from Laravel API with cache-busting timestamp
    const timestamp = Date.now();
    const response = await fetch(`${API_BASE_URL}/favicon?t=${timestamp}`, {
      cache: 'no-store', // Always get the latest from Laravel
      headers: {
        'Cache-Control': 'no-cache',
      },
    });

    if (!response.ok) {
      // If Laravel doesn't have a favicon, return a default SVG
      return new NextResponse(getDefaultFavicon(), {
        status: 200,
        headers: {
          'Content-Type': 'image/svg+xml',
          'Cache-Control': 'no-cache, no-store, must-revalidate',
          'Pragma': 'no-cache',
          'Expires': '0',
        },
      });
    }

    const imageBuffer = await response.arrayBuffer();
    const contentType = response.headers.get('content-type') || 'image/png';

    return new NextResponse(imageBuffer, {
      status: 200,
      headers: {
        'Content-Type': contentType,
        'Cache-Control': 'no-cache, no-store, must-revalidate',
        'Pragma': 'no-cache',
        'Expires': '0',
      },
    });
  } catch (error) {
    console.error('Failed to fetch favicon from API:', error);
    // Return default favicon on error
    return new NextResponse(getDefaultFavicon(), {
      status: 200,
      headers: {
        'Content-Type': 'image/svg+xml',
        'Cache-Control': 'no-cache, no-store, must-revalidate',
        'Pragma': 'no-cache',
        'Expires': '0',
      },
    });
  }
}

function getDefaultFavicon(): string {
  return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
  <rect width="32" height="32" fill="#dc2626" rx="7"/>
  <text x="16" y="23" font-family="system-ui, -apple-system, sans-serif" font-size="16" font-weight="bold" fill="white" text-anchor="middle" letter-spacing="-0.5">CP</text>
</svg>`;
}

