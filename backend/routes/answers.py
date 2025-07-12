from flask import Blueprint, request, jsonify
from extensions import db
from models.answer import Answer

answers_bp = Blueprint('answers', __name__)

@answers_bp.route('/', methods=['POST'])
def post_answer():
    data = request.json
    new_a = Answer(content=data['content'], question_id=data['question_id'], user_id=data['user_id'])
    db.session.add(new_a)
    db.session.commit()
    return jsonify({'message': 'Answer posted successfully'}), 201
