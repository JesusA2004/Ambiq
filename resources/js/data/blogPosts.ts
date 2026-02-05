// resources/js/data/blogPosts.ts
export type BlogPostBlock =
  | { type: 'h2'; text: string }
  | { type: 'p'; text: string }
  | { type: 'ul'; items: string[] }

export type BlogPost = {
  slug: string
  title: string
  excerpt: string
  coverImage?: string
  readTime?: string
  date?: string
  content: BlogPostBlock[]
}

export const blogPosts: BlogPost[] = [
  {
    slug: 'ley-de-economia-circular-que-es-y-por-que-es-clave',
    title: 'Ley de Economía Circular: qué es y por qué es clave para las organizaciones',
    excerpt:
      'Marco legal que impulsa producción y consumo sostenible: reducción de residuos, optimización de recursos y competitividad.',
    coverImage: '/img/blog/economia-circular.png',
    readTime: '6 min de lectura',
    date: '2026-02-05',
    content: [
      { type: 'h2', text: '¿Qué es la Ley de Economía Circular?' },
      {
        type: 'p',
        text:
          'La Ley de Economía Circular es un marco legal que promueve un modelo de producción y consumo sostenible, enfocado en reducir residuos, optimizar recursos y prolongar la vida útil de productos y materiales.',
      },

      { type: 'h2', text: 'Objetivo de la Ley' },
      {
        type: 'p',
        text:
          'El propósito principal es prevenir la generación de residuos y fomentar su valorización, integrando criterios de sostenibilidad en procesos productivos, comerciales y de gestión pública.',
      },

      { type: 'h2', text: 'Principios de la economía circular' },
      {
        type: 'p',
        text:
            'La Ley se basa en principios fundamentales que guían su aplicación:',
      },
      {
        type: 'ul',
        items: [
          'Prevención y reducción de residuos desde el diseño',
          'Uso eficiente de materias primas, agua y energía',
          'Reutilización, reciclaje y valorización de materiales',
          'Responsabilidad compartida y extendida',
          'Innovación y mejora continua',
        ],
      },
      {
        type: 'p',
        text:
            'Estos principios permiten cerrar ciclos productivos y minimizar impactos ambientales.',
      },

      { type: 'h2', text: '¿A quién aplica la Ley de Economía Circular?' },
      {
        type: 'p',
        text:
            'La Ley es de aplicación transversal y alcanza a:',
      },
      {
        type: 'ul',
        items: [
          'Empresas industriales, comerciales y de servicios',
          'Generadores de residuos sólidos urbanos y de manejo especial',
          'Gobiernos y entidades públicas',
          'Cadenas de suministro y logística',
        ],
      },
      {
        type: 'p',
        text:
            'Su cumplimiento implica la adopción de estrategias y programas alineados con la economía circular.',
      },

      { type: 'h2', text: 'Implicaciones para las empresas' },
      {
        type: 'p',
        text:
            'La implementación de la Ley de Economía Circular representa una oportunidad para las organizaciones de:',
      },
      {
        type: 'ul',
        items: [
          'Mejorar su cumplimiento normativo ambiental',
          'Reducir costos operativos mediante eficiencia de recursos',
          'Fortalecer su desempeño ESG',
          'Acceder a nuevos mercados y clientes responsables',
          'Reducir riesgos legales y reputacionales',
        ],
      },
      {
        type: 'p',
        text:
            'Las empresas que integran la economía circular en su estrategia fortalecen su sostenibilidad y competitividad.',
      },

      { type: 'h2', text: 'Nuestro enfoque como consultoría ambiental' },
      {
        type: 'p',
        text:
            'Como consultoría especializada en medio ambiente, apoyamos a las organizaciones en:',
      },
      {
        type: 'ul',
        items: [
          'Diagnóstico de cumplimiento con la Ley de Economía Circular',
          'Identificación de oportunidades de reducción y valorización de residuos',
          'Desarrollo de estrategias y planes de economía circular',
          'Acompañamiento técnico y regulatorio',
          'Capacitación al personal',
        ],
      },

      { type: 'h2', text: 'Conclusión' },
      {
        type: 'p',
        text:
          'La Ley de Economía Circular no es solo una obligación legal, sino una herramienta estratégica para la gestión ambiental moderna. Su correcta implementación permite a las organizaciones generar valor económico, ambiental y social de forma sostenible.',
      },
    ],
  },
]

export function getPostBySlug(slug: string) {
  return blogPosts.find((p) => p.slug === slug) ?? null
}
