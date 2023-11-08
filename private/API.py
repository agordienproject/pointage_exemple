from flask import Flask, request, jsonify
import mysql.connector

app = Flask(__name__)

# Configuration de la base de données MySQL
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': 'Grillon.2003',
    'database': 'pointage'
}

# Fonction pour se connecter à la base de données
def connect_to_database():
    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor()
    return conn, cursor

# Route pour récupérer des données de la base de données
@app.route('/api/data', methods=['GET'])
def get_data():
    conn, cursor = connect_to_database()
    cursor.execute("SELECT * FROM eleves")
    data = cursor.fetchall()
    conn.close()
    return jsonify(data)

if __name__ == '__main__':
    app.run(debug=True)
