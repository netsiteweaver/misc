import Link from "next/link";
import { Container } from "@/components/Container";
import { site } from "@/lib/site";

const nav = [
  { href: "/", label: "Home" },
  { href: "/catalog", label: "Catalog" },
  { href: "/about", label: "About" },
  { href: "/contact", label: "Contact" },
] as const;

export function Header() {
  return (
    <header className="sticky top-0 z-50 border-b border-zinc-200/70 bg-white/80 backdrop-blur">
      <div className="hidden border-b border-zinc-200 bg-zinc-950 text-white sm:block">
        <Container className="flex h-10 items-center justify-between text-xs">
          <div className="flex items-center gap-4">
            <span className="inline-flex items-center gap-2">
              <span className="h-1.5 w-1.5 rounded-full bg-red-500" />
              Quote fast on Facebook
            </span>
            <span className="text-white/70">
              Send car model/year + part name (or photo)
            </span>
          </div>
          <div className="flex items-center gap-4 text-white/80">
            {site.phone ? <span>Call: {site.phone}</span> : null}
            {site.hours ? <span>Hours: {site.hours}</span> : null}
          </div>
        </Container>
      </div>

      <Container className="flex h-16 items-center justify-between gap-4">
        <Link href="/" className="flex items-center gap-3 font-semibold">
          <span className="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-900 text-white">
            <span className="text-sm">CP</span>
          </span>
          <div className="leading-tight">
            <div className="text-sm sm:text-base">{site.name}</div>
            <div className="hidden text-xs font-normal text-zinc-500 sm:block">
              Car parts · Retail & wholesale
            </div>
          </div>
        </Link>

        <nav className="hidden items-center gap-7 sm:flex">
          {nav.map((item) => (
            <Link
              key={item.href}
              href={item.href}
              className="text-sm font-medium text-zinc-700 hover:text-zinc-900"
            >
              {item.label}
            </Link>
          ))}
        </nav>

        <div className="flex items-center gap-3">
          <a
            href={site.facebookUrl}
            target="_blank"
            rel="noopener noreferrer"
            className="hidden rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 sm:inline-flex"
          >
            Message on Facebook
          </a>

          <details className="relative sm:hidden">
            <summary className="list-none rounded-full border border-zinc-200 bg-white px-4 py-2 text-sm font-semibold text-zinc-900">
              Menu
            </summary>
            <div className="absolute right-0 mt-2 w-56 overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-lg">
              <div className="p-2">
                {nav.map((item) => (
                  <Link
                    key={item.href}
                    href={item.href}
                    className="block rounded-xl px-3 py-2 text-sm font-medium text-zinc-800 hover:bg-zinc-50"
                  >
                    {item.label}
                  </Link>
                ))}
                <a
                  href={site.facebookUrl}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="mt-1 block rounded-xl bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700"
                >
                  Facebook
                </a>
              </div>
            </div>
          </details>
        </div>
      </Container>
    </header>
  );
}

