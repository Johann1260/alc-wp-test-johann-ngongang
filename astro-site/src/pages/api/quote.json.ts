import type { APIRoute } from 'astro'

const quotes = [
  "La simplicité est la sophistication suprême.",
  "Code is like humor. When you have to explain it, it’s bad.",
  "L’avenir appartient à ceux qui préparent le présent.",
];

export const GET: APIRoute = async () => {
  const quote = quotes[Math.floor(Math.random() * quotes.length)];
  return new Response(JSON.stringify({ quote }), {
    headers: { 'Content-Type': 'application/json' },
  });
};
