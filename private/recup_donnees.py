import gspread
from oauth2client.service_account import ServiceAccountCredentials
import os
os.chdir('C:\\xampp\\htdocs\\pointage\\private')

# Spécifiez le nom de votre fichier JSON de clé d'API et le nom de votre feuille Google Sheets
credentials = ServiceAccountCredentials.from_json_keyfile_name('cle.json', ['https://spreadsheets.google.com/feeds', 'https://www.googleapis.com/auth/drive'])
client = gspread.authorize(credentials)

# Ouvrez la feuille Google Sheets par son nom
sheet = client.open('test').sheet1

# Obtenez toutes les valeurs dans la feuille
data = sheet.get_all_values()

# Affichez les données
for row in data:
    print(row)
