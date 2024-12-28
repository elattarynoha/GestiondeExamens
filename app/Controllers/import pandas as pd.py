import pandas as pd

# Charger les fichiers CSV dans des DataFrames pandas
produits_df = pd.read_csv("Produits.csv")
ventes_df = pd.read_csv("Ventes.csv")
magasin_df = pd.read_csv("Magasin.csv")

# Affichage des DataFrames pour vérifier le chargement
print("Produits:")
print(produits_df)
print("\nVentes:")
print(ventes_df)
print("\nMagasins:")
print(magasin_df)