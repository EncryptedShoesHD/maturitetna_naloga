function editExaminations(subjectID) {
  window.location.href = '../redovalnica/examinations.php?mode=edit&action=edit_exams&data=' + subjectID;
}

function editLesson(dayOfWeek, start, end) {
  window.location.href = '../redovalnica/schedule.php?mode=edit&action=edit_lesson&data=' + dayOfWeek + ';' + start + ';' + end;
}

function editGrade(gradeID) {
  window.location.href = '../redovalnica/grades.php?mode=edit&action=edit_grade&data=' + gradeID;
}
