# run steps
1 - create env
```bash
python3 -m venv venv
source venv/bin/activate
pip install -r requirements.txt
```
2 - database
```bash
sudo -u postgres psql
CREATE DATABASE cmsdb;
CREATE USER postgres WITH PASSWORD 'adminpassword';
GRANT ALL PRIVILEGES ON DATABASE cmsdb TO postgres;
\q
```
3 - 
change `DATABASE_URL` config on `app/config.py` by changing your username and password of database
```bash
export DATABASE_URL='postgresql://postgres:yourpassword@localhost:5432/cmsdb'
export SECRET_KEY='your-secret-key'
```
4 - run it 
```bash
python3 run.py
```

