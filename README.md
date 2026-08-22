# Krakowskie Centrum Medyczne, serwis internetowy

Statyczny serwis dla Krakowskiego Centrum Medycznego, Rynek 26 w Przemyślu.
Czysty HTML i CSS, bez zależności i bez procesu budowania.
Publikacja: GitHub Pages, domena `www.krakowskiecentrummedyczne.pl`.

## Struktura

```
index.html      strona główna
oferta.html     zakres opieki, sześć sekcji z kotwicami
lekarze.html    sylwetki sześciorga lekarzy
kontakt.html    adres, godziny, mapa, przygotowanie do wizyty
formularz.html  formularz kontaktowy
404.html        strona błędu
styl.css        wspólny arkusz stylów dla wszystkich stron

CNAME           domena, NIE KASOWAĆ
.nojekyll       wyłącza przetwarzanie Jekyllem
robots.txt      sitemap.xml

recepcja.jpg    zdjęcie wnętrza, tło nagłówków
og.jpg          miniatura przy udostępnianiu linku
favicon.ico     favicon.svg     apple-touch-icon.png
lek-*.jpg       sześć zdjęć lekarzy
```

Wszystkie pliki leżą w katalogu głównym. Nie ma podkatalogów, żeby nic nie
zginęło przy wgrywaniu przez przeglądarkę.

## Wgrywanie na zwykły hosting

Wgraj całą zawartość katalogu do folderu publicznego serwera, zwykle
`public_html`, `htdocs` albo `www`. Struktura jest płaska, więc nie trzeba
niczego przestawiać. Serwer nie wymaga PHP, bazy danych ani żadnych modułów.

Pliki `CNAME` i `.nojekyll` są potrzebne wyłącznie przy publikacji na GitHub
Pages. Na zwykłym hostingu nie przeszkadzają, można je też usunąć.

Formularz kontaktowy wysyła dane przez zewnętrzną usługę i działa tak samo
na każdym serwerze. W pliku `formularz.html` trzeba podmienić
`TWOJ_IDENTYFIKATOR` na identyfikator z formspree.io.

## Wgrywanie zmian na GitHub Pages

Repozytorium KCM na GitHubie, przycisk **Add file → Upload files**, przeciągnij
pliki na pole uploadu, potem **Commit changes**. Zmiana pojawia się na stronie
w ciągu minuty. Do podglądu użyj Ctrl+F5, bo przeglądarka trzyma stare pliki
w pamięci.

Pliku `CNAME` nie usuwaj. Bez niego domena natychmiast przestaje działać.

## Gdzie co zmienić

| Co | Gdzie |
|---|---|
| Numer telefonu | wszystkie pliki HTML, ciąg `790 866 877` oraz `tel:+48790866877` |
| Adres e-mail | wszystkie pliki HTML, ciąg `kontakt@krakowskiecentrummedyczne.pl` |
| Odbiorca formularza | `formularz.html`, atrybut `action` w znaczniku `<form>` |
| Godziny rejestracji | `index.html`, `kontakt.html`, stopka we wszystkich plikach, dane strukturalne w `index.html` i `kontakt.html` |
| Kolory, odstępy, kroje pisma | `styl.css`, sekcja `:root` na górze pliku |
| Lista usług | `oferta.html`, listy `<ul class="uslugi">` |
| Opis lekarza | `lekarze.html`, akapit `<p class="bio">` w karcie lekarza |
| Nowy lekarz | skopiuj całą kartę `<article class="doc rv">` i podmień treść oraz nazwę pliku zdjęcia |

## Zdjęcia lekarzy

Nazwy plików w katalogu głównym: `lek-jakubiec-wisniewska.jpg`,
`lek-wisniewski.jpg`, `lek-zembala-szczerba.jpg`, `lek-kornelak.jpg`,
`lek-stabrawa-lesniak.jpg`, `lek-merta.jpg`.

Kwadratowe, 800 na 800 pikseli, twarz w górnej jednej trzeciej kadru.
Brak pliku nie psuje strony: w jego miejscu pojawia się medalion z inicjałami.

## Mapa

Na stronie kontaktu jest mapa OpenStreetMap osadzona przez `iframe`, bez klucza
API i bez plików cookie. Pod mapą jest odnośnik do Map Google dla osób,
które chcą wyznaczyć trasę.

## Dane strukturalne

`index.html` i `kontakt.html` zawierają blok `MedicalClinic` w formacie
schema.org: adres, współrzędne, telefon, godziny otwarcia i specjalizacje.
To z niego Google buduje wizytówkę w wynikach wyszukiwania. Przy zmianie
godzin lub telefonu trzeba poprawić także ten blok.

## Podpis twórcy

W dolnym pasku stopki, na każdej stronie, znajduje się znak i odnośnik
`Projekt i wykonanie — Projekt X` prowadzący do `https://projektiks.pl`.
Znak jest wektorem wklejonym w kod (`.autor-znak`), nie wymaga pliku.

## Optymalizacja

Zdjęcia lekarzy występują w dwóch rozmiarach: `lek-*.jpg` (800 px) i
`lek-*-320.jpg` (320 px). Przeglądarka wybiera właściwy przez `srcset`.
Tło nagłówka ma wersję mobilną `recepcja-640.jpg`, podstawianą przez CSS
poniżej 900 px szerokości. Przy dodawaniu nowego lekarza trzeba wygenerować
oba rozmiary zdjęcia.

Na ekranach do 860 px pojawia się przyklejony pasek z przyciskami „Zadzwoń"
i „Zostaw numer", odsłaniany po przewinięciu 420 px. Na stronie zakresu opieki
listy usług poniżej 760 px startują zwinięte i rozwijają się po dotknięciu;
powyżej tej szerokości są zawsze otwarte.

## Zgodność z przeglądarkami

Arkusz stylów zawiera podpórki dla starszych wydań Safari i Firefoksa:
zapasowe proporcje obrazów dla przeglądarek bez `aspect-ratio`, prefiksy
`-webkit-` przy rozmyciu tła i kontrolkach formularzy, zapasową jednostkę
wysokości ekranu, zawijanie długiego adresu e-mail, obsługę trybu wysokiego
kontrastu oraz arkusz do druku. Pola formularza mają czcionkę 16,5 piksela,
przez co Safari na iPhonie nie przybliża widoku po dotknięciu pola.

## Sprawdzone przed publikacją

Sześć stron na siedmiu szerokościach ekranu od 320 pikseli: brak poziomego
przewijania, żaden element nie wystaje poza ekran, wszystkie obrazy się
ładują, pola dotyku powyżej 38 pikseli, wszystkie odnośniki wewnętrzne
i kotwice prowadzą do istniejących miejsc, walidacja i wysyłka formularza
przetestowane, strona działa także przy niedostępnych krojach pisma
z Google Fonts.
