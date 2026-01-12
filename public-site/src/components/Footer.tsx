import { Container } from "@/components/Container";
import { SiteSettings } from "@/lib/api";

interface FooterProps {
  site: SiteSettings;
}

export function Footer({ site }: FooterProps) {
  const year = new Date().getFullYear();
  return (
    <footer className="border-t border-zinc-200 bg-white">
      <Container className="py-10">
        <div className="grid gap-6 md:grid-cols-3">
          <div>
            <div className="text-base font-semibold text-zinc-900">
              {site.name}
            </div>
            <p className="mt-2 text-sm text-zinc-600">{site.tagline}</p>
          </div>

          <div className="text-sm text-zinc-600">
            <div className="font-semibold text-zinc-900">Contact</div>
            <ul className="mt-2 space-y-1">
              {site.phone ? <li>Phone: {site.phone}</li> : <li>Phone: (add)</li>}
              {site.email ? <li>Email: {site.email}</li> : <li>Email: (add)</li>}
              {site.hours ? <li>Hours: {site.hours}</li> : <li>Hours: (add)</li>}
            </ul>
          </div>

          <div className="text-sm text-zinc-600">
            <div className="font-semibold text-zinc-900">Links</div>
            <ul className="mt-2 space-y-1">
              <li>
                <a
                  href={site.facebookUrl}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="hover:text-zinc-900"
                >
                  Facebook page
                </a>
              </li>
              <li>
                <a href="/contact" className="hover:text-zinc-900">
                  Request a quote
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div className="mt-8 border-t border-zinc-200 pt-6 text-xs text-zinc-500">
          © {year} {site.name}. All rights reserved.
        </div>
      </Container>
    </footer>
  );
}

