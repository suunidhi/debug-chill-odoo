class Config:
    MYSQL_USER = 'root'
    MYSQL_PASSWORD = 'ShikhaaShah@17'  # Replace with your real MySQL password
    MYSQL_DB = 'debugchill'
    MYSQL_HOST = 'localhost'
    SQLALCHEMY_DATABASE_URI = f'mysql://{MYSQL_USER}:{MYSQL_PASSWORD}@{MYSQL_HOST}/{MYSQL_DB}'
    SQLALCHEMY_TRACK_MODIFICATIONS = False
