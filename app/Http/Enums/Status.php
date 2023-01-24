<?php

enum Status: String {
    case NEW = 'new';
    case DESIGN = 'design';
    case DEVELOPMENT = 'development';
    case FINISHED = 'finished';
    case FROZEN = 'frozen';
}