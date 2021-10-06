;;; ������ ������� ������ ��������� 3 ������ (������ ���������� �� �������). � ����
;;; ������� ������������� ���������� set, let � setq �� �����������! 
;;; ��� ������� ������ ���� ������������
;;; ������� �6: 3, 5, 12

(format t "~%#####################################~%#             ������� #6            #~%#####################################~%~%~%")


;;; ���������� ��������, �����������:
;;; 3) �������� �� ��� ��������� ���������������.
(format t "���������� ��������, �����������:~%3) �������� �� ��� ��������� ���������������.~%���������:~%")
(defun intersectingSets (A B)
    (cond
    ((null A) NIL)
    ((member (CAR A) B) T)
    (T (intersectingSets (CDR A) B))
    )
)
(setq A '(1 2))
(setq B '(3 1 4))
(format t "   A=~A, B=~A -> ~A~%" A B (intersectingSets A B))
(format t "~%~%")

;;; ���������� �������:
;;; 5) ������������ ����������� ���� ��������.
(format t "���������� �������:~%5) ������������ ����������� ���� ��������.~%���������:~%")
(defun unionSets (A B)
    (cond 
    ((null A) B)
    ((null B) A)
    ((member (CAR A) B) (unionSets (CDR A) B))
    (T (cons (CAR A) (unionSets (CDR A) B)))
    )
)
(setq A '(1 2))
(setq B '(2 3 4 5))
(format t "   A=~A, B=~A -> ~A~%" A B (unionSets A B))
(setq A '(0 1 2 3 4 5 a))
(setq B '(5 4 3))
(format t "   A=~A, B=~A -> ~A~%" A B (unionSets A B))
(format t "~%~%")

;;; ���������� ����������:
;;; 12) ����������� ��������� MAPLIST ��� ������������ ������. 
;;; (����������� ����������� ���������� FUNCALL).
(format t "���������� ����������:~%12) ����������� ��������� MAPLIST ��� ������������ ������.(����������� ����������� ���������� FUNCALL).~%���������:~%")
(defun maplst (fun A)
    (cond
    ((null A) NIL)
    (T (cons (funcall fun A) (maplst fun (CDR A))))
    )
)
(setq A '(1 2 3 4 5))
(setq fun (function reverse))
(format t "   A=~A, fun=~A -> ~A~%" A fun (maplst fun A))
(setq A '(a b c))
(setq fun (function (lambda (x) (cons 0 x))))
(format t "   A=~A, fun=~A -> ~A~%" A fun (maplst fun A))
(format t "~%~%")


