;;; ?????? ??????? ?????? ????????? 3 ?????? (?????? ?????????? ?? ???????). ? ????
;;; ??????? ????????????? ?????????? set, let ? setq ?? ???????????! ??? ??????? ??????
;;; ???? ????????????, ??????????? ?? ????????????.
;;; ??????? ?6: 6, 16, 26

(format t "~%#####################################~%#             ??????? #6            #~%#####################################~%~%~%")


;; 6) ???????? ?????? "????????" ? ??????? ??????????? n ??? ????????? x.
;; ????????, n=4, x=* ?> ((((*))))
(format t "?????????? ???????:~%6) ???????? ?????? \"????????\" ? ??????? ??????????? n ??? ????????? x.~%?????????:~%")
(defun onion (x n)
    (if (eql n 0) 
        x 
        (list (onion x (- n 1)))
    )
)
(setq x "*")
(setq n 4)
(format t "   x=~A, n=~A -> ~A~%" x n (onion x n))
(format t "~%~%")


;; 16) ?????????????? ??????????? ????? ? ?????? L ?? n ????????? ??????.
;; ????????, L = (a s d f g), n = 3 ?> (d f g a s)
(format t "?????????? ???????:~%16) ?????????????? ??????????? ????? ? ?????? L ?? n ????????? ??????.~%?????????:~%")
(defun cyclicShift (L n)
    (if (eql n 0) 
        L 
        (cyclicShift (append (last L) (butlast L)) (- n 1))
    )
)
(setq L '(d f g a s))
(setq n 3)
(format t "   L=~A, n=~A -> ~A~%" L n (cyclicShift L n))
(format t "~%~%")


;; 26) ??????????? ?????????? ?????? ? ????????? ????????? (?? ???? ???????).
;; ????????, ((a b) c ((d a v))) ?> 6
(format t "?????????? ???????:~%26) ??????????? ?????????? ?????? ? ????????? ????????? (?? ???? ???????).~%?????????:~%")
(defun numAtoms (L)
    (if (not (null L))
        (+ 
        (if (consp (CAR L))
            (numAtoms(CAR L))
            1
        )
        (numAtoms (CDR L))
        )
        0
    )
)
(setq L '((a b) c ((d a v))))
(format t "   L=~A -> ~A~%" L (numAtoms L))
(format t "~%~%")
