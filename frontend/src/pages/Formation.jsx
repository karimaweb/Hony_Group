import "./Formation.css";

const formations = [
  {
    title: "Langues",
    description:
      "Cours de français, anglais et autres langues adaptés aux besoins professionnels.",
  },
  {
    title: "Informatique",
    description:
      "Formation bureautique, développement web, outils numériques et technologies modernes.",
  },
  {
    title: "Tourisme",
    description:
      "Formation liée au secteur du tourisme et accueil client.",
  },
];

export default function Formation() {
  return (
    <div className="formation-page">

      <section className="hero">
        <h1>HONEY GROUP FORMATION</h1>

        <p>
          Développez vos compétences grâce à nos formations professionnelles.
        </p>
      </section>

      <section className="formations-section">
        <h2>Nos Modules de Formation</h2>

        <div className="formations-grid">
          {formations.map((formation, index) => (
            <div className="card" key={index}>
              <h3>{formation.title}</h3>

              <p>{formation.description}</p>

              <button>En savoir plus</button>
            </div>
          ))}
        </div>
      </section>

    </div>
  );
}