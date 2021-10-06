#ifndef STRUCTURE_HPP
#define STRUCTURE_HPP

struct list
{
    char data[80];
    struct list *previous;
    struct list *next;
};

#endif

