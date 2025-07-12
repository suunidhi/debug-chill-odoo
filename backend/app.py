from flask import Flask,jsonify
from flask_cors import CORS
from extensions import db
from models import db, Question
from config import Config

@app.route("/api/questions", methods=["GET"])
def get_questions():
    questions = Question.query.order_by(Question.created_at.desc()).all()
    return jsonify([
        {
            "id": q.id,
            "title": q.title,
            "description": q.description,
            "created_at": q.created_at.strftime("%Y-%m-%d %H:%M:%S")
        }
        for q in questions
    ])


app = Flask(__name__)
app.config.from_object(Config)
CORS(app)
db.init_app(app)

from routes.auth import auth_bp
from routes.questions import questions_bp
from routes.answers import answers_bp

app.register_blueprint(auth_bp, url_prefix='/api/auth')
app.register_blueprint(questions_bp, url_prefix='/api/questions')
app.register_blueprint(answers_bp, url_prefix='/api/answers')

if __name__ == '__main__':
    app.run(debug=True)
