###Wp-wizard###

To wtyczka, strona połączona z api VIrustotal przedstawiająca w jaki sposób dbać o bezpieczeństwo wordpress, najważniejsze jest ukrycie wtyczek i tematów z domyślnych ścieżek, ponieważ w przypadku nieaktualizowanych wersji zwyczajnie będą nie aktualne podatne na atatki przez kogokolwiek wystarczy zajrzeć do publicznej bazy exploitami i skorzystać z ich, by uzyskać dostęp do strony w przypadku ukrycia ścieżek.

Wordpress naprawa 
1. Backup (manual, duplicator).
2. Manualny test strony - zdefiniowanie błędów.
3. Zdefiniowanie przydatności plików.
4. Skanowanie url.
- virustotal
- sucuri
5. Skanowanie virusTotal
- plugins
- themes
6. Zdefiniowanie szkód w temacie “wyglądzie strony” po oczyszczeniu lub wgraniu
czystej wersji.
7. Skanowania ręczne przy użyciu find. (opcjonalnie)
8. Skanowanie uploads przy użyciu find i dodanie .htaccess .php forbidden.
9. Skanowanie po oczyszczeniu malcare - weryfikacja kompletnej czystości strony
10. Instalacja firewall - malcare.
11. Zapora XSS - malcare.
12. Vulnerability - malcare.
13. Wyczyszczenie bazy danych z niepotrzebny użytkowników, definiowanie defektów w
zawartości, strukturze bazy danych wprowadzonych przez “malware”.
14. Oczyszczenie spamu, zainstalowanie antispam.
15. Ukrycie ścieżek wp-ghost, sprawdzenie poprawności ukrycia wpscan.
16. Zainstalowanie wp-wizard (opcjonalnie w celu sprawdzenia namnażania).
