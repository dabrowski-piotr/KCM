# Krakowskie Centrum Medyczne, strona przejściowa

Statyczna strona „w budowie" dla Krakowskiego Centrum Medycznego (Rynek 26, Przemyśl).
Bez zależności i bez procesu budowania. Czysty HTML i CSS.

## Struktura

```
.
├── index.html          # strona główna
├── 404.html            # strona błędu, ten sam layout
├── robots.txt
├── sitemap.xml
├── .nojekyll           # wyłącza przetwarzanie Jekyllem na GitHub Pages
└── assets/
    ├── logo-mark.png       # znak „k+" na przezroczystości
    ├── recepcja.jpg        # tło hero
    ├── og.jpg              # miniatura do udostępniania (1200×630)
    ├── favicon-32.png
    ├── favicon-512.png
    └── apple-touch-icon.png
```

## Publikacja na GitHub Pages

```bash
git init
git add .
git commit -m "Strona przejściowa KCM"
git branch -M main
git remote add origin https://github.com/dabrowski-piotr/kcm.git
git push -u origin main
```

Potem: **Settings → Pages → Source: Deploy from a branch → `main` / `root` → Save**.
Po chwili strona jest pod `https://dabrowski-piotr.github.io/kcm/`.

## Własna domena

1. W katalogu głównym utwórz plik `CNAME` z jedną linią, np. `krakowskiecm.pl`.
2. U rejestratora domeny ustaw rekordy A na adresy GitHub Pages
   (`185.199.108.153`, `185.199.109.153`, `185.199.110.153`, `185.199.111.153`),
   a dla `www` rekord CNAME na `dabrowski-piotr.github.io`.
3. W Settings → Pages wpisz domenę i zaznacz **Enforce HTTPS**.

## Do podmiany po uruchomieniu domeny

Adres `https://dabrowski-piotr.github.io/kcm/` występuje w trzech miejscach.
Po podpięciu domeny podmień go na docelowy:

- `index.html` → `<link rel="canonical">`
- `robots.txt` → linia `Sitemap:`
- `sitemap.xml` → `<loc>`

W `index.html` warto też zamienić względny `og:image` na pełny adres
(`https://.../assets/og.jpg`). Część serwisów nie rozwija ścieżek względnych
przy generowaniu podglądu linku.

## Dane do potwierdzenia z klientem

- Godziny przyjęć poszczególnych lekarzy (na stronie podane są tylko godziny
  rejestracji: 9:00–18:00 codziennie).
- Czy podajemy datę uruchomienia pełnego serwisu. Obecnie jest neutralne
  „wkrótce", bez konkretnego terminu.
- Adres e-mail do kontaktu, jeśli ma się pojawić obok telefonu.

## Materiały

Zdjęcie recepcji i znak graficzny pochodzą z materiałów klienta.
Treści merytoryczne (zakres usług) pochodzą z profilu na Facebooku oraz
z artykułu o otwarciu placówki w „Życiu Podkarpackim" (14.01.2022).
