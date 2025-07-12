from flask import Blueprint, request, jsonify
from extensions import db
from models.question import Question

questions_bp = Blueprint('questions', __name__)

@questions_bp.route('/', methods=['GET'])
def get_questions():
    questions = Question.query.all()
    return jsonify([{'id': q.id, 'title': q.title, 'description': q.description} for q in questions])

@questions_bp.route('/', methods=['POST'])
def post_question():
    data = request.json
    new_q = Question(title=data['title'], description=data['description'], user_id=data['user_id'])
    db.session.add(new_q)
    db.session.commit()
    return jsonify({'message': 'Question posted successfully'}), 201
