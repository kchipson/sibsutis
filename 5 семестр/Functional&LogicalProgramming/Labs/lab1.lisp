;;; 1. �������� ������� �������, ��������� ���������� ������� CAR � CDR, 
;;; ������� ���������� ���� * ��� ���������� � ���������� ������:
;;; 6) ((1 2) (3 (4 *) 5))

;; (write (CAR (CDR (CAR (CDR (CAR (CDR '((1 2) (3 (4 *) 5)))))))))
;; (write (CADR (CADADR '((1 2) (3 (4 *) 5)))))

(format t "1)~%~A~%~%"
    (CAR (CDR 
        (CAR (CDR 
            (CAR (CDR '((1 2) (3 (4 *) 5))
            ))
        ))
    ))
)


;;; 2. ��������� ������ ������� � ���������� ��������� ���������:
;;; 6) (append NIL '(a b c))
;;; ���������� : APPEND - "���������" ������
;;; ���������  : (A B C)

(format t "2)~%~A~%~%" (APPEND NIL '(a b c)))


;;; 3. �� ������ 1, 2, 3, nil �������� ��������� ������ ����� ���������:
;;; �) � ������� ���������� ������� CONS;
;;; �) � ������� ���������� ������� LIST.
;;; ������: 6) ((1(2 (3))))

;; (write (CONS (CONS 1 (CONS (CONS 2 (CONS (CONS 3 ()) ())) ())) ()))
(format t "3)~%�: ~A~%�: ~A~%~%" 
    ;; �)
    (CONS ;; ������� �������
        (CONS 
            1 
            (CONS 
                (CONS 
                    2 
                    (CONS 
                        (CONS 
                            3
                            NIL
                        )
                        NIL
                    )
                ) 
                NIL
            )
        ) 
        NIL
    )
    ;; �)
    (LIST (LIST 1 (LIST 2 (LIST 3))))
)



;;; 4. � ������� DEFUN ���������� �������, ������� ���������� ���������� ������ ��
;;; ������� (� ���� ������� ����������� ������������ ������ ��������� ����������
;;; �������: CAR, CDR, CONS, APPEND, LIST, LAST, BUTLAST � ����� ����������).
;;; ��������� � ������, ��������� ��������� � ������� �� �������� ������ �����.
;;; 6) ������� ������ ������� ������ � ������ �������� ������


(defun fun (x)
    ;; (CADDR x) - 3 �������
    ;; (CDDDR x) - 4-n ��������
    ;; (CADR x) - 2 �������
    ;;  (CAR x) - 1 �������
    (APPEND (LIST (CADDR x)) (LIST (CADR x)) (LIST (CAR x)) (CDDDR x))
) 
(format t 
"4)
������ 1: 
    ��������: ~A
    ��������: ~A
������ 2: 
    ��������: ~A
    ��������: ~A
������ 3: 
    ��������: ~A
    ��������: ~A
������ 4: 
    ��������: ~A
    ��������: ~A
������ 5: 
    ��������: ~A
    ��������: ~A" 
    '(1 2 3 4 5)
    (fun '(1 2 3 4 5))
    '(1 2 3 4 5 6 7 8 9 10)
    (fun '(1 2 3 4 5 6 7 8 9 10))
    '(1 2 3)
    (fun '(1 2 3))
    '(1 2)
    (fun '(1 2))
    '(1)
    (fun '(1))
)

