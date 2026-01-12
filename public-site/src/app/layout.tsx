import type { Metadata } from "next";
import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import { Header } from "@/components/Header";
import { Footer } from "@/components/Footer";
import { fetchSiteSettings } from "@/lib/api";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

import type { SiteSettings } from "@/lib/api";

// Default site settings (will be overridden if API call succeeds)
const defaultSite: SiteSettings = {
  name: "Car Parts Shop",
  tagline: "Quality car parts. Fast sourcing. Honest pricing.",
  phone: "",
  email: "",
  address: "",
  hours: "",
  facebookUrl: "",
  accentColorHex: "#ef4444",
};

// Try to fetch site settings for metadata
async function getSiteSettings(): Promise<SiteSettings> {
  try {
    return await fetchSiteSettings();
  } catch (error) {
    console.error("Failed to fetch site settings:", error);
    return defaultSite;
  }
}

export async function generateMetadata(): Promise<Metadata> {
  const site = await getSiteSettings();
  const faviconVersion = site.faviconVersion || Date.now();
  const iconUrl = `/icon?v=${faviconVersion}`;
  
  return {
    title: {
      default: site.name,
      template: `%s · ${site.name}`,
    },
    description: site.tagline,
    icons: {
      icon: iconUrl,
      shortcut: iconUrl,
      apple: iconUrl,
    },
  };
}

export default async function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  const site = await getSiteSettings();
  
  return (
    <html lang="en">
      <body
        className={`${geistSans.variable} ${geistMono.variable} min-h-dvh bg-white text-zinc-900 antialiased`}
      >
        <div className="flex min-h-dvh flex-col">
          <Header site={site} />
          <main className="flex-1">{children}</main>
          <Footer site={site} />
        </div>
      </body>
    </html>
  );
}
